<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\AuthController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Todos, paginados.
Route::middleware('auth:api')->post('/juegos/all', 'ApiController@allJuegos');
Route::middleware('auth:api')->post('/calificaciones/all', 'ApiController@allCalificaciones');
Route::middleware('auth:api')->post('/generos/all', 'ApiController@allGeneros');
Route::middleware('auth:api')->post('/plataformas/all', 'ApiController@allPlataformas');
Route::middleware('auth:api')->post('/editores/all', 'ApiController@allEditores');
Route::middleware('auth:api')->post('/desarrolladores/all', 'ApiController@allDesarrolladores');

//Consultas filtradas (próximamente).
