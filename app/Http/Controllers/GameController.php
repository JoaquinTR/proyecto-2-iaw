<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Muestra el formulario de carga de un juego nuevo.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newGame(){
        return view('dashboard.newGame');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de juegos.
     *
     * @return \Illuminate\Http\Response
     */
    public function newGameStore(Request $request){

    }
}
