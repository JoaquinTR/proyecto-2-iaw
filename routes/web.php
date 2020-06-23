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

Route::get('/', 'HomeController@index')->name('base');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->middleware('is_user')->name('profile');
Route::get('/profile/modify', 'ProfileModifyController@index')->name('modify_data');
Route::post('/profile/modify/name', 'ProfileModifyController@storeName')->name('modify_data.nombre');
Route::post('/profile/modify/email', 'ProfileModifyController@storeEmail')->name('modify_data.email');

Route::get('/profile/contraseña', 'PasswordModifyController@index')->name('modify_passw');
Route::post('/profile/contraseña', 'PasswordModifyController@store')->name('modify_passw');

Route::get('/dashboard', 'AdminController@index')->middleware('is_admin')->name('dashboard');
Route::get('/dashboard/games/allAjax', 'GameController@ajaxJuegos')->middleware('auth')->middleware('is_admin')->name('dashboard.game.all.ajax');
Route::get('/dashboard/games/getAjax/{id}', 'GameController@ajaxJuego')->middleware('auth')->middleware('is_admin')->name('dashboard.game.ajax');
Route::get('/dashboard/games/all', 'GameController@index')->middleware('auth')->middleware('is_admin')->name('dashboard.game.all');
Route::get('/dashboard/games/edit/{id}', 'GameController@updateIndex')->middleware('auth')->middleware('is_admin')->name('dashboard.game.edit');
Route::post('/dashboard/games/edit/{id}', 'GameController@update')->middleware('auth')->middleware('is_admin')->name('dashboard.game.edit');
Route::delete('/dashboard/games/delete/{id}', 'GameController@destroy')->middleware('auth')->middleware('is_admin')->name('dashboard.game.delete');
Route::get('/dashboard/games/new', 'GameController@newGame')->middleware('auth')->middleware('is_admin')->name('dashboard.game.new');
Route::post('/dashboard/games/new', 'GameController@newGameCreate')->middleware('auth')->middleware('is_admin')->name('dashboard.game.new');

Route::get('/dashboard/images/all', 'ImageController@index')->middleware('is_admin')->name('dashboard.image.all');
Route::get('/dashboard/images/allAjax', 'ImageController@ajaxImagenes')->middleware('is_admin')->name('dashboard.image.all.ajax');
Route::get('/dashboard/images/ver/{id}', 'ImageController@verImagen')->middleware('is_admin')->name('dashboard.image.ver');
Route::delete('/dashboard/images/delete/{id}', 'ImageController@destroy')->middleware('is_admin')->name('dashboard.image.delete');
Route::get('/dashboard/images/new', 'ImageController@newImage')->middleware('is_admin')->name('dashboard.image.new');
Route::post('/dashboard/images/new', 'ImageController@newImageCreate')->middleware('is_admin')->name('dashboard.image.new');

Route::get('/decoradores/all', 'DecoradorController@index')->middleware('is_admin')->name('dashboard.decoradores.all');
Route::get('/decoradores/new', 'DecoradorController@newDecorador')->middleware('is_admin')->name('dashboard.decoradores.new');
Route::delete('/decoradores/delete/{id}/{tipo}', 'DecoradorController@deleteDecorador')->middleware('is_admin')->name('dashboard.decoradores.delete');
Route::post('/decoradores/genero', 'DecoradorController@createGenero')->middleware('is_admin')->name('dashboard.decoradores.genero');
Route::post('/decoradores/plataforma', 'DecoradorController@createPlataforma')->middleware('is_admin')->name('dashboard.decoradores.plataforma');
Route::post('/decoradores/editor', 'DecoradorController@createEditor')->middleware('is_admin')->name('dashboard.decoradores.editor');
Route::post('/decoradores/desarrollador', 'DecoradorController@createDesarrollador')->middleware('is_admin')->name('dashboard.decoradores.desarrollador');
Route::get('/decoradores/genero', 'DecoradorController@ajaxGenero')->middleware('is_admin')->name('dashboard.decoradores.genero.ajax');
Route::get('/decoradores/plataforma', 'DecoradorController@ajaxPlataforma')->middleware('is_admin')->name('dashboard.decoradores.plataforma.ajax');
Route::get('/decoradores/editor', 'DecoradorController@ajaxEditor')->middleware('is_admin')->name('dashboard.decoradores.editor.ajax');
Route::get('/decoradores/desarrollador', 'DecoradorController@ajaxDesarrollador')->middleware('is_admin')->name('dashboard.decoradores.desarrollador.ajax');

Route::get('/dashboard/usuarios', 'AdminController@allUsers')->middleware('is_admin')->name('dashboard.usuarios');
Route::get('/dashboard/usuarios/allAjax', 'AdminController@ajaxUsers')->middleware('is_admin')->name('dashboard.usuarios.ajax');
Route::post('/dashboard/usuarios/adminificar/{id}', 'AdminController@adminificar')->middleware('is_admin')->name('dashboard.usuarios.adminificar');

Route::get('/dashboard/calificaciones/all', 'CalificacionController@index')->middleware('is_admin')->name('dashboard.calificacion.all');
Route::post('/calificación/new/{id}','CalificacionController@newCalificacion')->middleware('auth')->name('calificacion.nueva');
Route::get('/dashboard/calificaciones/allAjax', 'CalificacionController@ajaxCalificaciones')->middleware('is_admin')->name('dashboard.calificacion.all.ajax');

Route::get('/games', 'GameController@main')->name('games'); //pantalla principal de todos los juegos
Route::post('/games', 'GameController@busquedaJuego')->name('games'); //pantalla principal de todos los juegos, filtros aplicados
Route::get('/games/{id}', 'GameController@juegoDetalles')->name('game'); //pantalla principal de un juego particular
Route::get('/games/detalles/{id}', 'GameController@juegoDetalles')->name('game.detalles'); //pantalla principal de un juego particular, url alternativa
Route::get('/games/review/{id}/{filtro?}', 'GameController@juegoReview')->name('game.review'); //pantalla de reseñas de un juego

//Verificación de mail de usuario
Route::get('/verify', function () {
    return view('auth.verify');
})->middleware('is_user')->name('verify');
