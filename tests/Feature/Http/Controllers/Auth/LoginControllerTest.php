<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
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

    public function testToLogWithSocialProvider()
    {
        $provider = \Mockery::mock(\Laravel\Socialite\Contracts\Provider::class);
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

    public function testToLogWithSocialProviderThatNotExists()
    {
        Socialite::shouldReceive('driver')
            ->with('unknown')
            ->andThrowExceptions([new \InvalidArgumentException()]);

        $this
            ->followingRedirects()
            ->from('/login')
            ->get('/login/unknown')
            ->assertSuccessful()
            ->assertSeeText('Login');
//            ->assertSeeText('La liaison de votre compte unknown avec votre compte utilisateur n\'a pas pu se faire');
    }

//    public function testToLogWithSocialProviderOnCallback()
//    {
//        $abstractUser = \Mockery::mock(\Laravel\Socialite\Two\User::class)
//            ->shouldReceive('getId')
//            ->andReturn($this->faker->uuid)
//            ->shouldReceive('getEmail')
//            ->andReturn($this->faker->email)
//            ->shouldReceive('getNickname')
//            ->andReturn($this->faker->userName)
//            ->shouldReceive('getName')
//            ->andReturn($this->faker->name)
//            ->shouldReceive('getAvatar')
//            ->andReturn('https://en.gravatar.com/userimage');
//
//        $provider = \Mockery::mock(\Laravel\Socialite\Contracts\Provider::class)
//            ->shouldReceive('user')
//            ->andReturn($abstractUser);
//
//        Socialite::shouldReceive('driver')
//            ->with('twitter')
//            ->andReturn($provider);
//
//        $this
//            ->followingRedirects()
//            ->from('/login/twitter')
//            ->get('/login/twitter/callback')
//            ->assertSuccessful();
//    }
}
