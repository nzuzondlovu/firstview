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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
	return view('home');
});

Route::get('/create', function () {

	if (Auth::guest()) {
		return \Redirect::to('/login');
	} else {
		return view('create');
	}    
});

Route::get('/index', function () {

	if (Auth::guest()) {
		return \Redirect::to('/login');
	} else {
		return view('index');
	}
});


Route::get('/company', function () {

	if (Auth::guest()) {
		return \Redirect::to('/login');
	} else {
		return view('company');
	}
});

Route::get('/index', 'CreatesController@index');

Route::post('/insert', 'CreatesController@add');

Route::get('/company/{id}', 'CreatesController@update');

Route::post('/update/{id}', 'CreatesController@edit');


