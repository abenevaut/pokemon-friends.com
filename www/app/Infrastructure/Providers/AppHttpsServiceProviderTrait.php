<?php

namespace pkmnfriends\Infrastructure\Providers;

use Illuminate\Support\Facades\URL;

trait AppHttpsServiceProviderTrait
{

    /**
     * Force the application to serve data via HTTPS.
     *
     * @return $this
     */
    public function forceHttps(): self
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        return $this;
    }
}
