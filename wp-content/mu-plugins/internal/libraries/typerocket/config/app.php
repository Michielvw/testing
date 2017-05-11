<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Enabled Plugins
    |--------------------------------------------------------------------------
    |
    | The folder names of the TypeRocket plugins you wish to enable.
    |
    */
    'plugins' => [
        'theme-options'
    ],

    /*
    |--------------------------------------------------------------------------
    | Debug
    |--------------------------------------------------------------------------
    |
    | Turn on Debugging for TypeRocket. Set to false to disable.
    |
    */
    'debug' => true,

    /*
    |--------------------------------------------------------------------------
    | Seed
    |--------------------------------------------------------------------------
    |
    | A 'random' string of text to help with security from time to time.
    |
    */
    'seed' => 'seed_58084241a72b4',

    /*
    |--------------------------------------------------------------------------
    | Icons
    |--------------------------------------------------------------------------
    |
    | The icon class to use for the admin.
    |
    */
    'icons' => \TypeRocket\Elements\Icons::class,

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | The main user class.
    |
    */
    'user' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    | The templates to use for the TypeRocket theme. Set to false if using
    | a theme or `templates` if using core for templates. Must be using
    | TypeRocket as root.
    |
    */
    'templates' => false,

    /*
    |--------------------------------------------------------------------------
    | Configurations
    |--------------------------------------------------------------------------
    |
    | Load other configurations
    |
    */
    'configurations' => [
        'paths'
    ]

];
