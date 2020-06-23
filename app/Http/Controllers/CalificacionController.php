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

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de juegos.
     *
     * @return \Illuminate\Http\Response
     */
    public function newCalificacion(Request $request, $juego_id){

        $request->validate(
            [
                'puntaje' => 'required',
                'descripcion' => 'required',
                'reseña' => 'required|min:15',
                'tipo' => 'required|in:jugador,casual'
            ],
            [
                'puntaje.required' => 'Se necesita un puntaje.',
                'descripcion.required' => 'Se necesita una descripción de tu calificación.',
                'reseña.required' => 'Se necesita una reseña.',
                'reseña.min' => 'El juego debe tener una reseña, al menos corta, de 15 caracteres.',
                'tipo.required' => 'Por favor, especificá un tipo.',
                'tipo.in' => 'Elegí si jugaste o no a este juego.',
        ]);

        $input = $request->all();

        $c = new Calificacion;

        $c->puntaje = $input["puntaje"];
        $c->juego_id = $juego_id;
        $c->users_id = auth()->user()->id;
        $c->descripcion = $input["descripcion"];
        $c->reseña = $input["reseña"];
        $c->tipo = $input["tipo"];

        $c->save();

        return back()->with('success', 'Calificación creada correctamente.');
    }
}
