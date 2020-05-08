<?php

namespace Tests;

use NunoMaduro\Collision\Adapters\Laravel\ExceptionHandler;
use template\Exceptions\Handler;
use Illuminate\Foundation\{
    Testing\TestCase as BaseTestCase,
    Testing\WithFaker,
};

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    use ActingTestCaseTrait;
    use CreatesApplication;
    use SqliteHotfixTestCaseTrait;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->hotfixSqlite();
    }

    public function dateFormat()
    {
        return trans('global.date_format');
    }

    public function dateTimeFormat()
    {
        return trans('global.date_time_format');
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = $this->app->make(ExceptionHandler::class);
        $this
            ->app
            ->instance(ExceptionHandler::class,
                new class extends Handler {

                    public function __construct()
                    {
                    }

                    public function report(\Exception $e)
                    {
                    }

                    public function render($request, \Exception $e)
                    {
                        throw $e;
                    }
                });
    }
}
