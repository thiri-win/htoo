<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Browsershot Configuration
    |--------------------------------------------------------------------------
    |
    | In this file you can specify the paths for the node and npm binaries
    | and any other Browsershot-specific options. This is a more reliable
    | way to configure Browsershot than setting it in each route.
    |
    */

    // The path to the node binary.
    'node_binary' => env('NODE_BINARY_PATH', '/var/www/.nvm/versions/node/22/bin/node'),

    // The path to the npm binary.
    'npm_binary' => env('NPM_BINARY_PATH', '/var/www/.nvm/versions/node/22/bin/npm'),

    // The path to the node_modules directory.
    'node_modules_path' => env('NODE_MODULES_PATH', base_path('node_modules')),

    // Include the node_modules path in the PATH environment variable.
    'include_node_modules_in_path' => true,

    // Any arguments to pass to the Puppeteer browser.
    'args' => [],

    // The default timeout for Browsershot in seconds.
    'timeout' => 60,
];
