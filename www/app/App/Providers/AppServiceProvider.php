<?php

namespace pkmnfriends\App\Providers;

use Illuminate\Support\{Facades\Config, Facades\Schema, Facades\URL, ServiceProvider};
use Barryvdh\{
    Debugbar\ServiceProvider as DebugbarServiceProvider,
    LaravelIdeHelper\IdeHelperServiceProvider
};
use Sentry\Laravel\ServiceProvider as SentryServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     * @SuppressWarnings("unused")
     *
     * @return void
     */
    public function boot()
    {
        // @codeCoverageIgnoreStart
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        // https://laravel-news.com/laravel-5-4-key-too-long-error - mysql 5.6 @fortrabbit
//        Schema::defaultStringLength(191);
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
