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
Route::post('/token/reset', 'Auth\AuthController@reset');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Todos, paginados.
Route::middleware('auth:api')->get('/juegos/all', 'ApiController@allJuegos');
Route::middleware('auth:api')->get('/calificaciones/all', 'ApiController@allCalificaciones');
Route::middleware('auth:api')->get('/generos/all', 'ApiController@allGeneros');
Route::middleware('auth:api')->get('/plataformas/all', 'ApiController@allPlataformas');
Route::middleware('auth:api')->get('/editores/all', 'ApiController@allEditores');
Route::middleware('auth:api')->get('/desarrolladores/all', 'ApiController@allDesarrolladores');

//Consultas filtradas (próximamente).
