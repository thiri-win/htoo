<?php

return [
    /*
     * Here you can configure default Browsershot settings that will be applied
     * to all PDF generation. These settings can still be overridden using the
     * withBrowsershot() method on individual PDF instances.
     */
    'browsershot' => [
        /*
         * Configure the paths to Node.js, npm, Chrome, and other binaries.
         * Leave null to use system defaults or Browsershot's auto-detection.
         */
        'node_binary' => env('LARAVEL_PDF_NODE_BINARY', '/var/www/.nvm/versions/node/22/bin/node'),
        'npm_binary' => env('LARAVEL_PDF_NPM_BINARY', '/var/www/.nvm/versions/node/22/bin/npm'),
        'include_path' => env('LARAVEL_PDF_INCLUDE_PATH'),
        'chrome_path' => env('LARAVEL_PDF_CHROME_PATH'),
        'node_modules_path' => env('LARAVEL_PDF_NODE_MODULES_PATH', base_path('node_modules')),
        'bin_path' => env('LARAVEL_PDF_BIN_PATH', base_path('vendor/bin')),
        'temp_path' => env('LARAVEL_PDF_TEMP_PATH'),

        'no_sandbox' => env('LARAVEL_PDF_NO_SANDBOX', true),

        'timeout' =>60,
    ],
];
