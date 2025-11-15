<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Spatie\Browsershot\Browsershot;

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
        if (App::environment('production', 'live', 'staging')) {
            // Laravel Cloud Server များအတွက် သတ်မှတ်ထားသော Node Path
            Browsershot::setNodeBinary('/usr/bin/node');
        }
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
