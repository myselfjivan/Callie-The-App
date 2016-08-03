<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    //routes for user actions
    $api->post('auth/pregister', 'App\Api\V1\Controllers\OtpController@p_register');
    $api->post('auth/pverify', 'App\Api\V1\Controllers\OtpController@p_verify');

    //routes for user authentication
    $api->post('auth/login', 'App\Api\V1\Controllers\AuthenticateController@authenticate');

    //routes for status
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->post('status/store', 'App\Api\V1\Controllers\StatusController@store');
        $api->get('status', 'App\Api\V1\Controllers\StatusController@index');
        $api->get('status/last10', 'App\Api\V1\Controllers\StatusController@last10');
        $api->get('status/{mobile}', 'App\Api\V1\Controllers\StatusController@showOtherUserStatus');
    });

    //routes for contacts
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->post('contact/store', 'App\Api\V1\Controllers\ContactsController@store');
        $api->get('contact', 'App\Api\V1\Controllers\ContactsController@index');
    });
});
