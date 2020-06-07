<?php

namespace template\App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use template\Infrastructure\Interfaces\Domain\Users\Users\UserRolesInterface;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan([
            'trainer' => 'This client is a trainer',
            'bot' => 'This client is a bot',
            'twitch' => 'This client is a twitch bot',
        ]);
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        Passport::routes();

        Gate::define(UserRolesInterface::ROLE_ADMINISTRATOR, function ($user) {
            return $user->is_administrator;
        });

        Gate::define(UserRolesInterface::ROLE_CUSTOMER, function ($user) {
            return $user->is_customer;
        });
    }
}
