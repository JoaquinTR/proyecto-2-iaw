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
        $juegos_nuevos_recientes = Juego::select('id')->orderBy('created_at','DESC')->take(5)->get()->pluck('id');
        $recientes = Image::select('juego_id','imagen')->whereIn('juego_id',$juegos_nuevos_recientes)->where('nombre_vista','principal')->orderBy('created_at','DESC')->take(5)->get();
        //en el front end con juego_id creo la url
        $juegos_mas_comentados = Juego::orderBy('cant_calificaciones','DESC')->take(5)->get();
        $juegos_rating = Juego::orderBy('rating','DESC')->take(5)->get();
        return view('home',compact('recientes','juegos_mas_comentados','juegos_rating'));
    }
}
