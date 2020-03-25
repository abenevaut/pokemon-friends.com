<?php

namespace template\Http\Controllers\Auth;

use GuzzleHttp\Client as GuzzleHttpClient;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use template\Domain\Users\Profiles\Repositories\ProfilesRepositoryEloquent;
use template\Domain\Users\Users\Repositories\UsersRegistrationsRepositoryEloquent;
use template\Infrastructure\Contracts\Controllers\ControllerAbstract;
use template\Domain\Users\Users\User;

class RegisterController extends ControllerAbstract
{
    use RegistersUsers;
    use AuthRedirectTrait;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * @var UsersRegistrationsRepositoryEloquent
     */
    protected $r_users;

    /**
     * @var ProfilesRepositoryEloquent
     */
    protected $r_profiles;

    /**
     * RegisterController constructor.
     *
     * @param UsersRegistrationsRepositoryEloquent $r_users
     * @param ProfilesRepositoryEloquent $r_profiles
     */
    public function __construct(
        UsersRegistrationsRepositoryEloquent $r_users,
        ProfilesRepositoryEloquent $r_profiles
    ) {
        $this->middleware('guest');
        $this->r_users = $r_users;
        $this->r_profiles = $r_profiles;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'civilities' => $this->r_users->getCivilities(),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect(route('register'))
                ->withErrors($validator)
                ->withInput();
        }

        $user = $this->create($request->all());
        event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if (
            !app()->environment('local')
            && !app()->environment('testing')
        ) {
            $remoteUrl = sprintf(
                'https://www.google.com/recaptcha/api/siteverify?secret=%s&response=%s&remoteip=%s',
                config('services.google_recaptcha.serverkey'),
                $data['g-recaptcha-response'],
                $_SERVER['REMOTE_ADDR']
            );

            $response = (new GuzzleHttpClient())
                ->request('GET', $remoteUrl);

            if (200 !== $response->getStatusCode()) {
                abort(403, 'Recaptcha verification failed!');
            }
        }

        return $this->r_users->registrationValidator($data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    protected function create(array $data)
    {
        $profile = $this
            ->r_profiles
            ->findByField('friend_code', $data['friend_code']);

        if ($profile->count() && $profile->first()->is_claimable) {
            return $this
                ->r_users
                ->update(
                    [
                        'civility' => User::CIVILITY_MADAM,
                        'first_name' => null,
                        'last_name' => null,
                        'role' => User::ROLE_CUSTOMER,
                        'locale' => User::DEFAULT_LOCALE,
                        'timezone' => User::DEFAULT_TZ,
                        'email' => $data['email'],
                        'password' => bcrypt($data['password']),
                    ],
                    $profile->first()->user->id
                );
        }

        $user = $this
            ->r_users
            ->registerUser(
                $data['email'],
                $data['password']
            );

        $user->profile->friend_code = $data['friend_code'];
        $user->profile->save();

        return $user;
    }
}
