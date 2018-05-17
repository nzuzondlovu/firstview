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
    return view('index');
});

Route::get('create', function () {
    return view('create');
});

Route::get('index', function () {
    return view('index');
});


Route::get('company', function () {
    return view('company');
});

Route::get('/', 'CreatesController@index');

Route::get('index', 'CreatesController@index');