<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        if (env('APP_ENV') == 'production') {
            // Force Browsershot to use the correct binary paths for Node and npm on production.
            // This is the most reliable way to configure it, bypassing any config caching issues.
            Pdf::defaultBrowsershot(function () {
                return new Browsershot(
                    nodeBinary: '/var/www/.nvm/versions/node/22/bin/node',
                    npmBinary: '/var/www/.nvm/versions/node/22/bin/npm'
                ))->noSandbox();
            });
            $url->forceScheme('https');
        }
    }
}
