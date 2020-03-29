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
            ->assertSeeText('Sign up to share your friend code and join your trainer community!')
            ->assertSeeText('Now go share &#039;em all!')
            ->assertSeeText('Home')
            ->assertSeeText('Contact')
            ->assertSeeText('Terms of Service')
            ->assertSeeText('Login')
            ->assertSeeText('Register');
    }

    public function testAnonymousDashboardInFrench()
    {
        $this
            ->get('/?locale=fr')
            ->assertSuccessful()
            ->assertSeeText('Inscrivez-vous pour partager votre code ami et rejoindre vote communauté de dresseurs!')
            ->assertSeeText('Maintenant, allez tous les partager !')
            ->assertSeeText('Accueil')
            ->assertSeeText('Contact')
            ->assertSeeText('Conditions générales d&#039;utilisation')
            ->assertSeeText('Se connecter')
            ->assertSeeText('S&#039;inscrire');
    }

    public function testAnonymousDashboardInGerman()
    {
        $this
            ->get('/?locale=de')
            ->assertSuccessful()
            ->assertSeeText('Sign up to share your friend code and join your trainer community!')
            ->assertSeeText('Now go share &#039;em all!')
            ->assertSeeText('Home')
            ->assertSeeText('Contact')
            ->assertSeeText('Terms of Service')
            ->assertSeeText('Einloggen')
            ->assertSeeText('Registrieren');
    }

    public function testAnonymousDashboardInSpanish()
    {
        $this
            ->get('/?locale=es')
            ->assertSuccessful()
            ->assertSeeText('Sign up to share your friend code and join your trainer community!')
            ->assertSeeText('Now go share &#039;em all!')
            ->assertSeeText('Home')
            ->assertSeeText('Contact')
            ->assertSeeText('Terms of Service')
            ->assertSeeText('Iniciar sesión')
            ->assertSeeText('Registrarse');
    }

    public function testAnonymousDashboardInRussian()
    {
        $this
            ->get('/?locale=ru')
            ->assertSuccessful()
            ->assertSeeText('Sign up to share your friend code and join your trainer community!')
            ->assertSeeText('Now go share &#039;em all!')
            ->assertSeeText('Home')
            ->assertSeeText('Contact')
            ->assertSeeText('Terms of Service')
            ->assertSeeText('Авторизоваться')
            ->assertSeeText('регистр');
    }

    public function testAnonymousDashboardInChinese()
    {
        $this
            ->get('/?locale=zh-CN')
            ->assertSuccessful()
            ->assertSeeText('Sign up to share your friend code and join your trainer community!')
            ->assertSeeText('Now go share &#039;em all!')
            ->assertSeeText('Home')
            ->assertSeeText('Contact')
            ->assertSeeText('Terms of Service')
            ->assertSeeText('登录')
            ->assertSeeText('寄存器');
    }

    public function testTerms()
    {
        $this
            ->get('/terms-of-services')
            ->assertSuccessful()
            ->assertSeeText('www.pokemon-friends.com is a friend sharing code platform from the Pokemon Go game.');
    }

    public function testTermsInFrench()
    {
        $this
            ->get('/terms-of-services?locale=fr')
            ->assertSuccessful()
            ->assertSeeText('www.pokemon-friends.com est une plateforme de partage de code ami du jeu Pokemon Go.');
    }
}
