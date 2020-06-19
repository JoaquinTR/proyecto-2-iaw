<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calificacion;

class CalificacionController extends Controller
{
    /**
     * Retorna una vista con todos las calificaciones en la base de datos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $calificaciones = Calificacion::all('id','users_id','juego_id','reseña','descripcion','puntaje','tipo','updated_at');
        return view('dashboard.allCalificaciones',compact('calificaciones'));
    }
}
