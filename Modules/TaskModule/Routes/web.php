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

    Route::get('/home','CompanyController@dashboard')->name('dashboard');

    Route::resource('companies', 'CompanyController');

    Route::resource('employees', 'EmployeeController');

