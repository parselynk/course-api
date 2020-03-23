<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected static $setUpHasRunOnce = false;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    // public function seedDatabase()
    // {
    //     if (!static::$setUpHasRunOnce) {
    //         Artisan::call('migrate:fresh');
    //         Artisan::call(
    //             'db:seed',
    //             ['--class' => 'DatabaseSeeder']
    //         );
    //         static::$setUpHasRunOnce = true;
    //     }
    // }
}
