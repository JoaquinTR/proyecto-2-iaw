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
        return view('dashboard.allCalificaciones');
    }

    /**
     * Retorna las calificaciones ante una consulta ajax.
     */
    public function ajaxCalificaciones(Request $request){
        if($request->ajax()){
            $calificaciones = Calificacion::all('id','users_id','juego_id','reseña','descripcion','puntaje','tipo','updated_at');
            return \Response::json($calificaciones);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
