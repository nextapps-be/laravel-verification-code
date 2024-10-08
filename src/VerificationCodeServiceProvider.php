<?php

namespace Wotz\VerificationCode;

use Illuminate\Support\ServiceProvider;
use Wotz\VerificationCode\Console\PruneCommand;

class VerificationCodeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/verification-code.php' => base_path('config/verification-code.php'),
        ], 'config');

        if (! class_exists('CreateVerificationCodesTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_verification_codes_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_verification_codes_table.php'),
            ], 'migrations');
        }
    }

    public function register()
    {
        $this->app->bind('verification-code', function () {
            return new VerificationCodeManager();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/verification-code.php', 'verification-code');

        $this->commands([PruneCommand::class]);
    }
}
