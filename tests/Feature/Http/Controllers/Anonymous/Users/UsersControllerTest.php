<?php

namespace Tests\Feature\Http\Controllers\Anonymous\Users;

use Tests\OAuthTestCaseTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    use OAuthTestCaseTrait;
    use DatabaseMigrations;

    public function testAnonymousDashboard()
    {
        $this
            ->get('/')
            ->assertSuccessful()
            ->assertSee('Sign up to share your friend code and join your trainer community!')
            ->assertSee('Now go share &#039;em all!')
            ->assertSee('Home')
            ->assertSee('Contact')
            ->assertSee('Terms of Service')
            ->assertSee('Login')
            ->assertSee('Register');
    }

    public function testAnonymousDashboardInFrench()
    {
        $this
            ->get('/?locale=fr')
            ->assertSuccessful()
            ->assertSee('Inscrivez-vous pour partager votre code ami et rejoindre vote communauté de dresseurs!')
            ->assertSee('Maintenant, allez tous les partager !')
            ->assertSee('Accueil')
            ->assertSee('Contact')
            ->assertSee('Conditions générales d&#039;utilisation')
            ->assertSee('Se connecter')
            ->assertSee('S&#039;inscrire');
    }

    public function testAnonymousDashboardInGerman()
    {
        $this
            ->get('/?locale=de')
            ->assertSuccessful()
            ->assertSee('Sign up to share your friend code and join your trainer community!')
            ->assertSee('Now go share &#039;em all!')
            ->assertSee('Home')
            ->assertSee('Contact')
            ->assertSee('Terms of Service')
            ->assertSee('Einloggen')
            ->assertSee('Registrieren');
    }

    public function testAnonymousDashboardInSpanish()
    {
        $this
            ->get('/?locale=es')
            ->assertSuccessful()
            ->assertSee('Sign up to share your friend code and join your trainer community!')
            ->assertSee('Now go share &#039;em all!')
            ->assertSee('Home')
            ->assertSee('Contact')
            ->assertSee('Terms of Service')
            ->assertSee('Iniciar sesión')
            ->assertSee('Registrarse');
    }

    public function testAnonymousDashboardInRussian()
    {
        $this
            ->get('/?locale=ru')
            ->assertSuccessful()
            ->assertSee('Sign up to share your friend code and join your trainer community!')
            ->assertSee('Now go share &#039;em all!')
            ->assertSee('Home')
            ->assertSee('Contact')
            ->assertSee('Terms of Service')
            ->assertSee('Авторизоваться')
            ->assertSee('регистр');
    }

    public function testAnonymousDashboardInChinese()
    {
        $this
            ->get('/?locale=zh-CN')
            ->assertSuccessful()
            ->assertSee('Sign up to share your friend code and join your trainer community!')
            ->assertSee('Now go share &#039;em all!')
            ->assertSee('Home')
            ->assertSee('Contact')
            ->assertSee('Terms of Service')
            ->assertSee('登录')
            ->assertSee('寄存器');
    }

    public function testTerms()
    {
        $this
            ->get('/terms-of-services')
            ->assertSuccessful()
            ->assertSee('www.pokemon-friends.com is a friend sharing code platform from the Pokemon Go game.');
    }

    public function testTermsInFrench()
    {
        $this
            ->get('/terms-of-services?locale=fr')
            ->assertSuccessful()
            ->assertSee('www.pokemon-friends.com est une plateforme de partage de code ami du jeu Pokemon Go.');
    }
}
