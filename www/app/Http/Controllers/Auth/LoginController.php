<?php

namespace pkmnfriends\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use pkmnfriends\Infrastructure\Controllers\ControllerAbstract;
use pkmnfriends\Domain\Users\ProvidersTokens\Repositories\ProvidersTokensRepositoryEloquent;
use pkmnfriends\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

class LoginController extends ControllerAbstract
{
    use AuthenticatesUsers;

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles \Authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * @var UsersRepositoryEloquent|null
     */
    protected $rUsers = null;

    /**
     * @var ProvidersTokensRepositoryEloquent|null
     */
    protected $rProvidersTokens = null;

    /**
     * LoginController constructor.
     *
     * @param UsersRepositoryEloquent $rUsers
     * @param ProvidersTokensRepositoryEloquent $rProvidersTokens
     */
    public function __construct(
        UsersRepositoryEloquent $rUsers,
        ProvidersTokensRepositoryEloquent $rProvidersTokens
    ) {
        $this->middleware('guest', [
            'except' => [
                'logout',
                'redirectToProvider',
                'handleProviderCallback',
            ],
        ]);

        $this->rUsers = $rUsers;
        $this->rProvidersTokens = $rProvidersTokens;
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request $request
     * @param  mixed $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $this->rUsers->refreshSession($user);

        return redirect(route('anonymous.dashboard'));
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @param $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\InvalidArgumentException $exception) {
            app('sentry')->captureException($exception);

            return back()
                ->with(
                    'message-error',
                    trans('auth.link_provider_failed', ['provider' => $provider]),
                );
        }
    }

    /**
     * Obtain the user information from provider if user exists.
     * No registration here, login only.
     *
     * @param $provider
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->user();

            if ($providerUser && Auth::check()) {
                $isTokenAvailableForUser = $this
                    ->rProvidersTokens
                    ->checkIfTokenIsAvailableForUser(
                        Auth::user(),
                        $providerUser->id,
                        $provider
                    );

                if ($isTokenAvailableForUser) {
                    $this
                        ->rProvidersTokens
                        ->saveUserTokenForProvider(
                            Auth::user(),
                            $provider,
                            $providerUser->id,
                            $providerUser->token
                        );

                    return redirect(route('customer.users.edit', ['user' => Auth::user()->uniqid]))
                        ->with(
                            'message-success',
                            trans('auth.link_provider_success', ['provider' => $provider])
                        );
                }

                return redirect(route('customer.users.edit', ['user' => Auth::user()->uniqid]))
                    ->with(
                        'message-error',
                        trans('auth.link_provider_failed', ['provider' => $provider])
                    );
            }

            $providerToken = $this
                ->rProvidersTokens
                ->findUserForProvider($providerUser->id, $provider);

            if ($providerToken) {
                $this
                    ->rProvidersTokens
                    ->update(
                        [
                            'provider_token' => $providerUser->token,
                        ],
                        $providerToken->id
                    );

                Auth::login($providerToken->user, true);

                return redirect(route('anonymous.dashboard'));
            }
        } catch (\InvalidArgumentException $exception) {
            app('sentry')->captureException($exception);

            return redirect(route('login'))
                ->with(
                    'message-error',
                    trans('auth.link_provider_failed', ['provider' => $provider])
                );
        }

        return redirect(route('login'))
            ->with(
                'message-error',
                trans('auth.login_with_provider_failed', ['provider' => $provider])
            );
    }
}
