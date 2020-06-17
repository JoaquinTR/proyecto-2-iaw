<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;

class DecoradorController extends Controller
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
     * Muestra los formularios de creación de decoradores.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('dashboard.decoradores');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de Genero.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGenero(Request $request){

        $request->validate(
            [
                'nombre' => 'required|unique:genero',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para el genero.',
                'nombre.unique' => 'Ya existe un genero con este nombre, revise la base de datos por favor.'
            ]
        );

        $input = $request->all();


        $genero = new Genero;

        $genero->nombre = $input["nombre"];

        $genero->save();

        return back()->with('success', 'Genero creado correctamente.');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de Plataforma.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPlataforma(Request $request){

        $request->validate(
            [
                'nombre' => 'required|unique:plataforma',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para la plataforma.',
                'nombre.unique' => 'Ya existe una plataforma con este nombre, revise la base de datos por favor.'
            ]
        );

        $input = $request->all();

        $plataforma = new Plataforma;

        $plataforma->nombre = $input["nombre"];

        $plataforma->save();

        return back()->with('success', 'Plataforma creada correctamente.');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de Editor.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEditor(Request $request){

        $request->validate(
            [
                'nombre' => 'required|unique:editor',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para el editor.',
                'nombre.unique' => 'Ya existe un editor con este nombre, revise la base de datos por favor.'
            ]
        );

        $input = $request->all();

        $editor = new Editor;

        $editor->nombre = $input["nombre"];

        $editor->save();

        return back()->with('success', 'Editor creado correctamente.');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de Desarrollador.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDesarrollador(Request $request){

        $request->validate(
            [
                'nombre' => 'required|unique:desarrollador',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para el desarrollador.',
                'nombre.unique' => 'Ya existe un desarrollador con este nombre, revise la base de datos por favor.'
            ]
        );

        $input = $request->all();

        $desarrollador = new Desarrollador;

        $desarrollador->nombre = $input["nombre"];

        $desarrollador->save();

        return back()->with('success', 'Desarrollador creado correctamente.');
    }
}
