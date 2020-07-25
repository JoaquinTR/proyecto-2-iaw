<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;
use App\Juego;
use App\Pedido;

class PedidoController extends Controller
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
     * Retorna una vista con todos los juegos en la base de datos. Panel admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('dashboard.allPedidos');
    }

    /**
     * Muestra el formulario de carga de un juego nuevo.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tomarPedido($id){
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();
        $pedido = Pedido::findOrFail($id);
        return view('dashboard.tomarPedido',compact('generos','plataformas','editores','desarrolladores','pedido'));
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de juegos,
     * tomando como base el pedido de un usuario.
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
        $juego->fecha_lanzamiento = $input["date"];
        $juego->genero = json_encode($input["generos_id"], JSON_UNESCAPED_UNICODE );
        $juego->plataforma = json_encode($input["plataformas_id"], JSON_UNESCAPED_UNICODE );
        $juego->editor = json_encode($input["editores_id"], JSON_UNESCAPED_UNICODE );
        $juego->desarrollador = json_encode($input["desarrolladores_id"], JSON_UNESCAPED_UNICODE );
        $juego->created_at = now();
        $juego->updated_at = now();
        $juego->puntaje = 0;
        $juego->cant_calificaciones = 0;

        //dd($juego);
        $juego->save();
        $pedido = Pedido::findOrFail($input["pedido_id"]);
        $pedido->delete();

        return redirect('/dashboard/pedidos/all')->with('success', 'Juego creado correctamente.');
    }

    /**
     * Remueve el pedido.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect('/dashboard/pedidos/all')->with('success', 'Se ha eliminado correctamente el pedido.');
    }

    /**
     * Retorna los pedidos ante una consulta ajax.
     */
    public function ajaxPedidos(Request $request){
        if($request->ajax()){
            $pedidos = Pedido::all();
            return \Response::json($pedidos);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }

    /**
     * Retorna el juego con el id proporcionado ante una consulta ajax.
     */
    public function ajaxPedido(Request $request, $id){
        if($request->ajax()){
            $pedido = Pedido::findOrFail($id);
            return \Response::json($pedido);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
