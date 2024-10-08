<?php

namespace Wotz\VerificationCode\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Orchestra\Testbench\TestCase as Orchestra;
use Wotz\VerificationCode\VerificationCodeServiceProvider;

abstract class TestCase extends Orchestra
{
    use WithFaker,
        DatabaseMigrations;

    protected function setUp() : void
    {
        parent::setUp();

        $this->setUpDatabase();

        Notification::fake();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageProviders($app) : array
    {
        return [
            VerificationCodeServiceProvider::class,
        ];
    }

    protected function setUpDatabase() : void
    {
        include_once __DIR__ . '/../database/migrations/create_verification_codes_table.php.stub';

        (new \CreateVerificationCodesTable())->up();
    }
}
