<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    //routes for user actions
    $api->post('auth/pregister', 'App\Api\V1\Controllers\AuthController@p_register');
    $api->post('auth/pverify', 'App\Api\V1\Controllers\AuthController@p_verify');

});