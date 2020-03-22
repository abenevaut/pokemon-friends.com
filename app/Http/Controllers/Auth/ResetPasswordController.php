<?php

namespace template\Http\Controllers\Auth;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use template\Domain\Users\Users\Repositories\UsersResetPasswordRepositoryEloquent;
use template\Infrastructure\Contracts\Controllers\ControllerAbstract;

class ResetPasswordController extends ControllerAbstract
{
    use ResetsPasswords;
    use AuthRedirectTrait;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    /**
     * @var UsersResetPasswordRepositoryEloquent
     */
    protected $r_users;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersResetPasswordRepositoryEloquent $r_users)
    {
        $this->middleware('guest');
        $this->r_users = $r_users;
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $this->request = $request;

        return parent::reset($request);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        $rules = $this->r_users->getResetPasswordRules();
        $rules['g-recaptcha-response'] = 'required';

        if (
            app()->environment('local')
            || app()->environment('testing')
        ) {
            unset($rules['g-recaptcha-response']);
        } else {
            $remoteUrl = sprintf(
                'https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s&remoteip=%s',
                config('services.google_recaptcha.serverkey'),
                $this->request->get('g-recaptcha-response'),
                $_SERVER['REMOTE_ADDR']
            );

            $response = (new GuzzleHttpClient())
                ->request('GET', $remoteUrl);

            if (200 !== $response->getStatusCode()) {
                abort(403, 'Recaptcha verification failed!');
            }
        }

        return $rules;
    }
}
