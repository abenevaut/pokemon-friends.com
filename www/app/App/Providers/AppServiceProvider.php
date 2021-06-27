<?php

namespace pkmnfriends\App\Providers;

use Illuminate\Support\{
    Facades\Config,
    ServiceProvider
};
use Barryvdh\{
    Debugbar\ServiceProvider as DebugbarServiceProvider,
    LaravelIdeHelper\IdeHelperServiceProvider
};
use pkmnfriends\Infrastructure\Providers\{
    AppHttpsServiceProviderTrait,
    AppLambdaServerlessServiceProviderTrait,
};
use Sentry\Laravel\ServiceProvider as SentryServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use AppHttpsServiceProviderTrait;
    use AppLambdaServerlessServiceProviderTrait;

    /**
     * Bootstrap any application services.
     * @SuppressWarnings("unused")
     *
     * @return void
     */
    public function boot()
    {
        // @codeCoverageIgnoreStart
        $this
            ->forceHttps()
            ->verifyStorageAvailability();
        /*
         * Set app release for sentry.
         */
        Config::set('sentry.release', Config::get('version.app_tag'));
        // @codeCoverageIgnoreEnd
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // @codeCoverageIgnoreStart
        if ($this->app->environment('local')) {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(DebugbarServiceProvider::class);
        } elseif ($this->app->environment('production')) {
            $this->app->register(SentryServiceProvider::class);
        }
        // @codeCoverageIgnoreEnd
    }
}
