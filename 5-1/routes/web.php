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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => '', 'middleware' => 'auth'], function() {
    Route::get('sns/create', 'Admin\SnsController@add');
    Route::post('sns/create', 'Admin\SnsController@create');
    Route::get('sns/create', 'Admin\SnsController@index');
    Route::get('sns/delete/{id}', 'Admin\SnsController@delete');
});