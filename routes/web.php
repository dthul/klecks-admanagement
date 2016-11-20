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
    return redirect()->route('issues.latest');
});

// Issue
Route::get('/issues', 'IssueController@showAll')->name('issues.index');

Route::get('/issues/latest', 'IssueController@showLatest')->name('issues.latest');

Route::get('/issues/{id}', 'IssueController@show')->name('issues.issue');

Route::post('/issues', 'IssueController@create')->name('issues.create');

Route::post('/issues/{id}', 'IssueController@update')->name('issues.update');

Route::post('/issues/{id}/delete', 'IssueController@delete')->name('issues.delete');

// Customer
Route::get('/customers', 'CustomerController@showAll')->name('customers.index');

Route::post('/customers', 'CustomerController@create')->name('customers.create');

Route::post('/customers/{id}', 'CustomerController@update')->name('customers.update');

Route::post('/customers/{id}/delete', 'CustomerController@delete')->name('customers.delete');

// Adformat
Route::post('/issues/{issue_id}/adformats', 'AdformatController@create')->name('adformats.create');

Route::post('/adformats/{id}', 'AdformatController@update')->name('adformats.update');

Route::post('/adformats/{id}/delete', 'AdformatController@delete')->name('adformats.delete');

// Advertisement
Route::post('/advertisements', 'AdvertisementController@create')->name('advertisements.create');

Route::post('/advertisements/{id}', 'AdvertisementController@update')->name('advertisements.update');

Route::post('/advertisements/{id}/delete', 'AdvertisementController@delete')->name('advertisements.delete');

// Invoice
Route::get('/issues/{issue_id}/customers/{customer_id}/invoice', 'InvoiceController@show')->name('invoice');

Auth::routes();
