<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;
use App\Juego;

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
     * Retorna una vista con todos los juegos en la base de datos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $juegos = Juego::all();
        return view('dashboard.allGames',compact('juegos'));
    }

    /**
     * Muestra el formulario de carga de un juego nuevo.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newGame(){
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();
        return view('dashboard.newGame',compact('generos','plataformas','editores','desarrolladores'));
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de juegos.
     *
     * @return \Illuminate\Http\Response
     */
    public function newGameCreate(Request $request){

        $request->validate(
            [
                'nombre' => 'required|unique:juego',
                'desc' => 'required|min:20',
                'generos_id' => 'required',
                'plataformas_id' => 'required',
                'date' => 'required|date',
                'editores_id' => 'required',
                'desarrolladores_id' => 'required',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para el juego.',
                'nombre.unique' => 'Ya existe un juego con este nombre, revise la base de datos por favor.',
                'desc.required' => 'El juego debe tener una descripción.',
                'desc.min' => 'El juego debe tener una descripción, al menos corta, de 20 caracteres.',
                'generos_id.required' => 'El juego debe tener al menos un genero.',
                'plataformas_id.required' => 'El juego debe tener al menos una plataforma.',
                'date.required' => 'Por favor seleccione la fecha de lanzamiento.',
                'date.date' => 'Por favor seleccione una fecha utilizando el calendario.',
                'editores_id.required' => 'El juego debe tener al menos un editor.',
                'desarrolladores_id.required' => 'El juego debe tener al menos un desarrollador.'
            ]);

        $input = $request->all();

        $juego = new Juego;

        $juego->nombre = $input["nombre"];
        $juego->descripcion = $input["desc"];
        $juego->imagen = $input["imagen"];
        $juego->fecha_lanzamiento = $input["date"];
        $juego->genero = json_encode($input["generos_id"], JSON_UNESCAPED_UNICODE );
        $juego->plataforma = json_encode($input["plataformas_id"], JSON_UNESCAPED_UNICODE );
        $juego->editor = json_encode($input["editores_id"], JSON_UNESCAPED_UNICODE );
        $juego->desarrollador = json_encode($input["desarrolladores_id"], JSON_UNESCAPED_UNICODE );

        //dd($juego);
        $juego->save();

        return back()->with('success', 'Juego creado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIndex(Request $request, $id)
    {
        $juego = Juego::find($id);
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();
        return view('dashboard.editGame',compact('generos','plataformas','editores','desarrolladores','juego'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nombre' => 'required',
                'desc' => 'required|min:20',
                'generos_id' => 'required',
                'plataformas_id' => 'required',
                'date' => 'required|date',
                'editores_id' => 'required',
                'desarrolladores_id' => 'required',
            ],
            [
                'nombre.required' => 'Se necesita un nombre para el juego.',
                'desc.required' => 'El juego debe tener una descripción.',
                'desc.min' => 'El juego debe tener una descripción, al menos corta, de 20 caracteres.',
                'generos_id.required' => 'El juego debe tener al menos un genero.',
                'plataformas_id.required' => 'El juego debe tener al menos una plataforma.',
                'date.required' => 'Por favor seleccione la fecha de lanzamiento.',
                'date.date' => 'Por favor seleccione una fecha utilizando el calendario.',
                'editores_id.required' => 'El juego debe tener al menos un editor.',
                'desarrolladores_id.required' => 'El juego debe tener al menos un desarrollador.'
            ]);

        $juego = Juego::find($id);
        $input = $request->all();
        //$juego=array();

        $juego->nombre = $input["nombre"];
        $juego->descripcion = $input["desc"];
        //$juego->imagen = $input["imagen"];
        $juego->fecha_lanzamiento = $input["date"];
        $juego->genero = json_encode($input["generos_id"], JSON_UNESCAPED_UNICODE );
        $juego->plataforma = json_encode($input["plataformas_id"], JSON_UNESCAPED_UNICODE );
        $juego->editor = json_encode($input["editores_id"], JSON_UNESCAPED_UNICODE );
        $juego->desarrollador = json_encode($input["desarrolladores_id"], JSON_UNESCAPED_UNICODE );

        $juego->save();
        //Juego::whereId($id)->update($juego);

        return redirect('/dashboard/games/all')->with('success', 'Se ha actualizado correctamente el juego.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $juego = Juego::findOrFail($id);
        $juego->delete();

        return redirect('/dashboard/games/all')->with('success', 'Se ha eliminado correctamente el juego.');
    }
}