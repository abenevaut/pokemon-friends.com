<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Laravel\Socialite\{
    Contracts\Provider as SocialiteProvider,
    Facades\Socialite,
    Two\User as SocialiteUser
};
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login as LoginEvent;
use template\Domain\Users\Users\{
    Events\UserRefreshSessionEvent,
    User
};

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testToVisitLoginPage()
    {
        $this
            ->get('/login')
            ->assertSuccessful()
            ->assertSeeText('Login')
            ->assertSeeText('Change your password')
            ->assertSeeText('Register');
    }

    public function testToVisitLoginPageInFrench()
    {
        $this
            ->get('/login?locale=fr')
            ->assertSuccessful()
            ->assertSeeText('Se connecter')
            ->assertSeeText('Changer votre mot de passe')
            ->assertSeeText('S&#039;inscrire');
    }

    public function testToVisitLoginPageInGerman()
    {
        $this
            ->get('/login?locale=de')
            ->assertSuccessful()
            ->assertSeeText('Einloggen')
            ->assertSeeText('Ändern Sie Ihr Passwort')
            ->assertSeeText('Registrieren');
    }

    public function testToVisitLoginPageInSpanish()
    {
        $this
            ->get('/login?locale=es')
            ->assertSuccessful()
            ->assertSeeText('Iniciar sesión')
            ->assertSeeText('Cambia tu contraseña')
            ->assertSeeText('Registrarse');
    }

    public function testToVisitLoginPageInRussian()
    {
        $this
            ->get('/login?locale=ru')
            ->assertSuccessful()
            ->assertSeeText('Авторизоваться')
            ->assertSeeText('Изменить пароль')
            ->assertSeeText('регистр');
    }

    public function testToVisitLoginPageInChinese()
    {
        $this
            ->get('/login?locale=zh-CN')
            ->assertSuccessful()
            ->assertSeeText('登录')
            ->assertSeeText('更改您的密码')
            ->assertSeeText('寄存器');
    }

    public function testToLogAsAdministrator()
    {
        $user = factory(User::class)->states(User::ROLE_ADMINISTRATOR)->create();
        Event::fake();
        $this
            ->from('/login')
            ->post('/login', [
                'email' => $user->email,
                'password' => $this->getDefaultPassword(),
            ])
            ->assertRedirect('/');
        Event::assertDispatched(UserRefreshSessionEvent::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
        Event::assertDispatched(LoginEvent::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }

    public function testToLogAsCustomer()
    {
        $user = factory(User::class)->states(User::ROLE_CUSTOMER)->create();
        Event::fake();
        $this
            ->from('/login')
            ->post('/login', [
                'email' => $user->email,
                'password' => $this->getDefaultPassword(),
            ])
            ->assertRedirect('/');
        Event::assertDispatched(UserRefreshSessionEvent::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
        Event::assertDispatched(LoginEvent::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }

    public function testToSubmitEmptyLoginForm()
    {
        $this
            ->followingRedirects()
            ->from('/login')
            ->post('/login', [
                'email' => null,
                'password' => null,
            ])
            ->assertSuccessful()
            ->assertSeeText('The email field is required.')
            ->assertSeeText('The password field is required.');
    }

    public function testToSubmitLoginFormWithBadEmail()
    {
        $this
            ->followingRedirects()
            ->from('/login')
            ->post('/login', [
                'email' => $this->faker->text,
                'password' => $this->getDefaultPassword(),
            ])
            ->assertSuccessful()
            ->assertSeeText('These credentials do not match our records.');
    }

    public function testToSubmitLoginFormWithUnknownCredentials()
    {
        $this
            ->followingRedirects()
            ->from('/login')
            ->post('/login', [
                'email' => $this->faker->email,
                'password' => $this->getDefaultPassword(),
            ])
            ->assertSuccessful()
            ->assertSeeText('These credentials do not match our records.');
    }

    public function testToLogOnSocialProvider()
    {
        $provider = \Mockery::mock(SocialiteProvider::class);
        $provider
            ->shouldReceive('redirect')
            ->andReturn(redirect($this->faker->url));

        Socialite::shouldReceive('driver')
            ->with('twitter')
            ->andReturn($provider);

        $this
            ->from('/login')
            ->get('/login/twitter')
            ->assertRedirect();
    }

    public function testToLogOnUnknownSocialProvider()
    {
        Socialite::shouldReceive('driver')
            ->with('unknown')
            ->andThrowExceptions([new \InvalidArgumentException()]);

        $this
            ->followingRedirects()
            ->from('/login')
            ->get('/login/unknown')
            ->assertSuccessful()
            ->assertLocation('/login')
            ->assertSeeText('The link of your unknown account with your user account could not be done');
    }

    public function testToLogSocialProviderUser()
    {
        $abstractUser = \Mockery::mock(SocialiteUser::class);
        $abstractUser
            ->shouldReceive('getId')
            ->andReturn($this->faker->uuid)
            ->shouldReceive('getEmail')
            ->andReturn($this->faker->email)
            ->shouldReceive('getNickname')
            ->andReturn($this->faker->userName)
            ->shouldReceive('getName')
            ->andReturn($this->faker->name)
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = \Mockery::mock(SocialiteProvider::class);
        $provider
            ->shouldReceive('user')
            ->andReturn($abstractUser);

        Socialite::shouldReceive('driver')
            ->with('twitter')
            ->andReturn($provider);

        $this
            ->followingRedirects()
            ->from('/login/twitter')
            ->get('/login/twitter/callback')
            ->assertLocation('/login')
            ->assertSeeText(
                'This twitter account is not linked to any user account,'
                . ' please log in with your usual credentials then link your account to use the social login system'
            );
    }
}
