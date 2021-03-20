<?php

namespace pkmnfriends\Infrastructure\Providers;

use Illuminate\Support\Facades\Schema;

trait AppFortrabbitMysqlServiceProviderTrait
{

    /**
     * Fix default string size for MySQL.
     * https://laravel-news.com/laravel-5-4-key-too-long-error - mysql 5.6 @fortrabbit
     *
     * @todo xABE: remove this for serverless
     *
     * @return $this
     */
    public function fixDefaultStringSizeForMySQL(): self
    {
        Schema::defaultStringLength(191);

        return $this;
    }
}
