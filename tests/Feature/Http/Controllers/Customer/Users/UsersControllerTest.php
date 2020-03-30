<?php

namespace Tests\Feature\Http\Controllers\Customer\Users;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testToVisitDashboardAsAnonymous()
    {
        $this
            ->get('/users/dashboard')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function testToVisitDashboardAsCustomer()
    {
        $this->actingAsCustomer();
        $this
            ->assertAuthenticated()
            ->get('/users/dashboard')
            ->assertStatus(200)
            ->assertSeeText('Dashboard');
    }

    public function testToVisitAnonymousDashboardAsCustomer()
    {
        $this->actingAsCustomer();
        $this
            ->assertAuthenticated()
            ->get('/')
            ->assertStatus(302)
            ->assertRedirect('/users/dashboard');
    }

    public function testToSubmitUpdatePassword()
    {
        $newPassword = $this->faker->password(8);
        $user = $this->actingAsCustomer();
        $this
            ->assertAuthenticated()
            ->from("/users/{$user->uniquid}/edit")
            ->put("/users/password/{$user->uniquid}", [
                'password_current' => $this->getDefaultPassword(),
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ])
            ->assertRedirect("/users/{$user->uniquid}/edit");
        $user->refresh();
        $this->assertFalse(Hash::check($this->getDefaultPassword(), $user->password));
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }

    public function testToSubmitUpdatePasswordWithPasswordTooShort()
    {
        $newPassword = $this->faker->password(3, 7);
        $user = $this->actingAsCustomer();
        $this
            ->assertAuthenticated()
            ->followingRedirects()
            ->from("/users/{$user->uniquid}/edit")
            ->put("/users/password/{$user->uniquid}", [
                'password_current' => $this->getDefaultPassword(),
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
            ])
            ->assertSuccessful()
            ->assertSeeText('The password must be at least 8 characters.');
        $user->refresh();
        $this->assertFalse(Hash::check($newPassword, $user->password));
        $this->assertTrue(Hash::check($this->getDefaultPassword(), $user->password));
    }
}
