<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Issue
Route::get('/issues', ['as' => 'issues.index', 'uses' => 'IssueController@showAll']);

Route::get('/issues/latest', ['as' => 'issues.latest', 'uses' => 'IssueController@showLatest']);

Route::get('/issues/{id}', ['as' => 'issues.issue', 'uses' => 'IssueController@show']);

Route::post('/issues', ['as' => 'issues.create', 'uses' => 'IssueController@create']);

Route::post('/issues/{id}', ['as' => 'issues.update', 'uses' => 'IssueController@update']);

Route::post('/issues/{id}/delete', ['as' => 'issues.delete', 'uses' => 'IssueController@delete']);

// Customer
Route::get('/customers', ['as' => 'customers.index', 'uses' => 'CustomerController@showAll']);

Route::post('/customers', ['as' => 'customers.create', 'uses' => 'CustomerController@create']);

Route::post('/customers/{id}', ['as' => 'customers.update', 'uses' => 'CustomerController@update']);

Route::post('/customers/{id}/delete', ['as' => 'customers.delete', 'uses' => 'CustomerController@delete']);

// Adformat
Route::post('/issues/{issue_id}/adformats', ['as' => 'adformats.create', 'uses' => 'AdformatController@create']);

Route::post('/adformats/{id}', ['as' => 'adformats.update', 'uses' => 'AdformatController@update']);

Route::post('/adformats/{id}/delete', ['as' => 'adformats.delete', 'uses' => 'AdformatController@delete']);

// Advertisement
Route::post('/advertisements/{id}/delete', ['as' => 'advertisements.delete', 'uses' => 'AdvertisementController@delete']);

Route::post('/advertisements', ['as' => 'advertisements.create', 'uses' => 'AdvertisementController@create']);

Route::post('/advertisements/{id}', ['as' => 'advertisements.update', 'uses' => 'AdvertisementController@update']);

Route::post('/advertisements/{id}/delete', ['as' => 'advertisements.delete', 'uses' => 'AdvertisementController@delete']);

// Invoice
Route::get('/issues/{issue_id}/customers/{customer_id}/invoice', ['as' => 'invoice', 'uses' => 'InvoiceController@show']);
