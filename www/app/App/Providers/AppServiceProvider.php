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
use Illuminate\Notifications\Messages\MailMessage;
use pkmnfriends\Infrastructure\Providers\{
    AppHttpsServiceProviderTrait,
    AppLambdaServerlessServiceProviderTrait,
    // @todo xABE: remove this for serverless
    AppFortrabbitMysqlServiceProviderTrait
};
use Sentry\Laravel\ServiceProvider as SentryServiceProvider;
use Yaquawa\Laravel\EmailReset\Notifications\EmailResetNotification;

class AppServiceProvider extends ServiceProvider
{
    use AppHttpsServiceProviderTrait;
    use AppLambdaServerlessServiceProviderTrait;
    // @todo xABE: remove this for serverless
    use AppFortrabbitMysqlServiceProviderTrait;

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
            ->verifyStorageAvailability()
            // @todo xABE: remove this for serverless
            ->fixDefaultStringSizeForMySQL();

        /*
         * Set app release for sentry.
         */
        Config::set('sentry.release', Config::get('version.app_tag'));
        /*
         * Overwrite "Change your email" email title and view, to customize it.
         */
        EmailResetNotification::toMailUsing(function ($user, $token, $resetLink) {
            return (new MailMessage())
                ->subject(trans('auth.email_reset_title'))
                ->view('emails.users.users.reset_email', compact('token'));
        });
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
