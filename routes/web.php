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
})->name('index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('url', 'UrlController',['except' => ['show']]);
Route::get('/{url}/result', 'UrlController@result')->name('url.results');
Route::get('/{url}', 'UrlController@show')->name('url.redirect');