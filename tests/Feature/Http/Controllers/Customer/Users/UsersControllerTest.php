<?php

namespace Tests\Feature\Http\Controllers\Customer\Users;

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
}
