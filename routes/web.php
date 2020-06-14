<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->middleware('is_user')->name('profile');
Route::get('/profile/modify', 'ProfileModifyController@index')->middleware('is_user')->name('modify');
Route::post('/profile/modify', 'ProfileModifyController@store')->middleware('is_user')->name('modify');

Route::get('/profile/contraseña', 'PasswordModifyController@index')->middleware('is_user')->name('contraseña');
Route::post('/profile/contraseña', 'PasswordModifyController@store')->middleware('is_user')->name('contraseña');

Route::get('/dashboard', 'AdminController@index')->middleware('is_admin')->name('dashboard');

Route::get('/verify', function () {
    return view('auth.verify');
})->middleware('is_user')->name('verify');
