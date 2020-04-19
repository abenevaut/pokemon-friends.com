<?php

namespace template\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use template\Infrastructure\Interfaces\Domain\Users\Users\UserRolesInterface;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \template\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \template\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \template\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \template\Http\Middleware\VerifyCsrfToken::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \template\Http\Middleware\Locale::class,
            \template\Http\Middleware\TimeZones::class,
        ],
        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        UserRolesInterface::ROLE_ADMINISTRATOR => [
            \Illuminate\Auth\Middleware\Authenticate::class,
            'role:' => UserRolesInterface::ROLE_ADMINISTRATOR,
        ],
        UserRolesInterface::ROLE_CUSTOMER => [
            \Illuminate\Auth\Middleware\Authenticate::class,
            'role:' => UserRolesInterface::ROLE_CUSTOMER,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \template\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \template\Http\Middleware\AuthenticatedUserHasRole::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
