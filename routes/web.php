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

// Route::get('magic/login', 'Api\Auth\LoginController@login')->name('magic.login')->middleware(['guest', 'throttle:12,60']);

Route::get('settings', 'SettingsController@index')->name('settings.index');

Route::post('settings', 'SettingsController@store')->name('settings.store');
