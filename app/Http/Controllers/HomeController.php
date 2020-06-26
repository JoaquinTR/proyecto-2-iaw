<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Juego;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $juegos_nuevos_recientes = Juego::orderBy('created_at','DESC')->take(5)->get();

        //en el front end con juego_id creo la url
        $juegos_mas_comentados = Juego::orderBy('cant_calificaciones','DESC')->take(5)->get();
        $juegos_rating = Juego::orderBy('rating','DESC')->take(5)->get();
        return view('home',compact('juegos_nuevos_recientes','juegos_mas_comentados','juegos_rating'));
    }
}
