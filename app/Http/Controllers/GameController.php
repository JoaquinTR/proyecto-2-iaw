<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;
use App\Juego;
use App\Image;
use App\Calificacion;

class GameController extends Controller
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
        return view('dashboard.allGames');
    }

    /**
     * Retorna una vista con la pantalla principal de juegos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main(){
        return view('games');
    }

    /**
     * Retorna una vista principal de un juego.
     *
     * @param $id El id del juego en cuestión.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function juegoDetalles(Request $request, $id){

        $juego = Juego::findOrFail($id);
        $imagen_principal = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','principal')->get()[0]->imagen;
        $imagen_fondo = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','fondo')->get()[0]->imagen;
        $tab = 0;
        return view('games.gameDetails',compact('juego','imagen_principal','imagen_fondo','tab'));
    }

    /**
     * Retorna una vista principal de un juego.
     *
     * @param $id El id del juego en cuestión.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function juegoReview(Request $request, $id, $filtro = 'recientes'){
        //filtro in ['recientes','viejos','calif_alta','calif_baja']
        $juego = Juego::findOrFail($id);
        $id_user = auth()->user()->id;
        $imagen_principal = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','principal')->get()[0]->imagen;
        $imagen_fondo = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','fondo')->get()[0]->imagen;
        $tab=1;

        $calificaciones = array();
        $total = 0;
        //calificaciones
        foreach(range(10,1) as $p){
            $calificaciones[$p] = count(Calificacion::where('puntaje',$p)->where('juego_id',$juego->id)->get());
            $total += $calificaciones[$p];
        }

        $mis_calificaciones = Calificacion::where('juego_id',$juego->id)->where('users_id',$id_user)->orderBy('created_at','DESC')->get();

        $calif_users = Calificacion::where('juego_id',$juego->id)->where('users_id', '!=' ,$id_user);

        switch($filtro){
            case 'recientes':
                $calif_users = $calif_users->orderBy('created_at','DESC');
            break;

            case 'viejos':
                $calif_users = $calif_users->orderBy('created_at','ASC');
            break;

            case 'calif_alta':
                $calif_users = $calif_users->orderBy('puntaje','DESC');
            break;

            case 'calif_baja':
                $calif_users = $calif_users->orderBy('puntaje','ASC');
            break;

            default:
                return abort(404); //la ruta no está contemplada en la agregación.
            break;
        }

        $calif_users = $calif_users->Paginate(12);

        return view('games.gameReviews',compact('juego','imagen_principal','imagen_fondo','tab','calificaciones','total','mis_calificaciones','calif_users','filtro'));
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
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();
        return view('dashboard.editGame',compact('generos','plataformas','editores','desarrolladores','id'));
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

        $juego->nombre = $input["nombre"];
        $juego->descripcion = $input["desc"];
        $juego->fecha_lanzamiento = $input["date"];
        $juego->genero = json_encode($input["generos_id"], JSON_UNESCAPED_UNICODE );
        $juego->plataforma = json_encode($input["plataformas_id"], JSON_UNESCAPED_UNICODE );
        $juego->editor = json_encode($input["editores_id"], JSON_UNESCAPED_UNICODE );
        $juego->desarrollador = json_encode($input["desarrolladores_id"], JSON_UNESCAPED_UNICODE );
        $juego->updated_at = now();

        $juego->save();

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

    /**
     * Retorna los juegos ante una consulta ajax.
     */
    public function ajaxJuegos(Request $request){
        if($request->ajax()){
            $juegos = Juego::all();
            return \Response::json($juegos);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }

    /**
     * Retorna el juego con el id proporcionado ante una consulta ajax.
     */
    public function ajaxJuego(Request $request, $id){
        if($request->ajax()){
            $juego = Juego::findOrFail($id);
            return \Response::json($juego);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
