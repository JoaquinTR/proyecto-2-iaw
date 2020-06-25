<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Juego;
use App\Calificacion;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //Pagina todos los juegos en tandas de 50
    public function allJuegos(){
        try {

            $juegos = Juego::select('id','nombre','genero','fecha_lanzamiento','descripcion','plataforma','editor','desarrollador','puntaje','cant_calificaciones','rating')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $juegos
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los juegos'
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allCalificaciones(){
        try {

            $calificaciones = Calificacion::select('id','users_id','juego_id','reseña','descripcion','puntaje','tipo')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $calificaciones
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los juegos'
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allGeneros(){
        try {

            $generos = Genero::select('id','nombre')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $generos
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los géneros'
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allPlataformas(){
        try {

            $plataformas = Plataforma::select('id','nombre')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $plataformas
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener las plataformas'
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allEditores(){
        try {

            $editores = Editor::select('id','nombre')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $editores
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los editores'
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allDesarrolladores(){
        try {

            $desarrolladores = Desarrollador::select('id','nombre')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $desarrolladores
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los desarrolladores'
            ]);
        }
    }
}
