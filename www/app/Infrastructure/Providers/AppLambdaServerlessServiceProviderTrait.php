<?php

namespace pkmnfriends\Infrastructure\Providers;

trait AppLambdaServerlessServiceProviderTrait
{

    /**
     * Verify the lambda storage directory exists and writable.
     *
     * @return $this
     */
    public function verifyStorageAvailability(): self
    {
        if ($this->app->environment('production')) {
            $this->app->useStoragePath(
                env('APP_STORAGE', $this->app->storagePath())
            );

            // Make sure the directory for compiled views exists #serverless
            if (!is_dir(config('view.compiled'))) {
                mkdir(config('view.compiled'), 0755, true);
            }

            // Make sure the directory for cache exists #serverless
            if (!is_dir(config('cache.stores.file.path'))) {
                mkdir(config('cache.stores.file.path'), 0755, true);
            }
        }

        return $this;
    }
}
