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
        // Force Browsershot to use the correct binary paths for Node and npm.
        // This is the most reliable way to configure it, especially for production environments.
        Pdf::defaultBrowsershot(function () {
            $nodePath = '/var/www/.nvm/versions/node/22/bin/node';
            $npmPath = '/var/www/.nvm/versions/node/22/bin/npm';

            return new Browsershot($nodePath, $npmPath);
        });
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
