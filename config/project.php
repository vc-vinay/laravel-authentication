<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Prefix
    |--------------------------------------------------------------------------
    |
    | This value is the admin prefix of your application.
    |
    */

    'admin_prefix' => env('ADMIN_PREFIX', 'console'),
    'writer_prefix' => env('WRITER_PREFIX', 'writer'),

    /*
    |--------------------------------------------------------------------------
    | Home Path
    |--------------------------------------------------------------------------
    |
    | Here you may configure the path where users will get redirected during
    | authentication or password reset when the operations are successful
    | and the user is authenticated. You are free to change this value.
    |
    */

    'home' => 'admin.dashboard',
];
