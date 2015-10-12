<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoices', function () {
    return 'Invoices';
});

Route::get('/issues', function () {
    return 'Issues';
});

Route::get('/issues/{id}', function ($id) {
    return 'Issue '.$id;
});

Route::get('/customers', function () {
    return 'Customers';
});
