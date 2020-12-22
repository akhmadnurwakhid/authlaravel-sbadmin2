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

Route::get('/','PageController@home')->name('home');


Route::get('/login','AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login','AuthController@postLogin')->middleware('guest')->name('post-login');
Route::get('/register','AuthController@getRegister')->middleware('guest')->name('register');
Route::post('/register','AuthController@postRegister')->middleware('guest')->name('post-register');

Route::get('logout','AuthController@logout')->middleware('auth')->name('logout');
