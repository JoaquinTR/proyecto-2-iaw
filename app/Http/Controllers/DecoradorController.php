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
     * Muestra las tablas de decoradores.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('dashboard.allDecoradores');
    }

    /**
     * Muestra los formularios de creación de decoradores.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newDecorador(){
        return view('dashboard.newDecorador');
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
        $genero->created_at = now();
        $genero->updated_at = now();

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
        $plataforma->created_at = now();
        $plataforma->updated_at = now();

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
        $editor->created_at = now();
        $editor->updated_at = now();

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
        $desarrollador->created_at = now();
        $desarrollador->updated_at = now();

        $desarrollador->save();

        return back()->with('success', 'Desarrollador creado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $tipo
     * @return \Illuminate\Http\Response
     */
    public function deleteDecorador($id,$tipo)
    {
        switch((string)$tipo){
            case'genero':
                Genero::findOrFail($id)->delete();
            break;
            case'plataforma':
                Plataforma::findOrFail($id)->delete();
            break;
            case'editor':
                Editor::findOrFail($id)->delete();
            break;
            case'desarrollador':
                Desarrollador::findOrFail($id)->delete();
            break;
        }

        return redirect(route('dashboard.decoradores.all'))->with('success', 'Se ha eliminado correctamente el recurso.');
    }

    /**
     * Retorna los generos ante una consulta ajax.
     */
    public function ajaxGenero(Request $request){
        if($request->ajax()){
            $generos = Genero::all();
            return \Response::json($generos);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }

    /**
     * Retorna las plataformas ante una consulta ajax.
     */
    public function ajaxPlataforma(Request $request){
        if($request->ajax()){
            $plataformas = Plataforma::all();
            return \Response::json($plataformas);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }

    /**
     * Retorna los editores ante una consulta ajax.
     */
    public function ajaxEditor(Request $request){
        if($request->ajax()){
            $editores = Editor::all();
            return \Response::json($editores);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }

    /**
     * Retorna los desarrolladores ante una consulta ajax.
     */
    public function ajaxDesarrollador(Request $request){
        if($request->ajax()){
            $desarrolladores = Genero::all();
            return \Response::json($desarrolladores);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
