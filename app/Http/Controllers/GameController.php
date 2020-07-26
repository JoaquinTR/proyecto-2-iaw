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
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();

        $juegos = Juego::orderBy('fecha_lanzamiento', 'DESC')->Paginate(12);
        return view('games',compact('generos','plataformas','editores','desarrolladores','juegos'));
    }

    /**
     * Retorna una vista principal de un juego.
     *
     * @param $id El id del juego en cuestión.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function juegoDetalles(Request $request, $id){

        $juego = Juego::findOrFail($id);
        $imagen_principal = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','principal')->get();

        if(count($imagen_principal))
            $imagen_principal = $imagen_principal[0]->imagen;
        else
            $imagen_principal = 0;

        $imagen_fondo = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','fondo')->get();
        if(count($imagen_fondo))
            $imagen_fondo = $imagen_fondo[0]->imagen;
        else
            $imagen_fondo = 0;

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
        $id_user = null;
        if(auth()->user()) $id_user = auth()->user()->id;
        $imagen_principal = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','principal')->get();
        $imagen_fondo = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','fondo')->get();

        if(count($imagen_principal))
            $imagen_principal = $imagen_principal[0]->imagen;
        else
            $imagen_principal = 0;

        $imagen_fondo = $juego->imagenes()->getQuery()->select('imagen')->where('nombre_vista','fondo')->get();
        if(count($imagen_fondo))
            $imagen_fondo = $imagen_fondo[0]->imagen;
        else
            $imagen_fondo = 0;

        $tab=1;

        $calificaciones = array();
        $total = 0;
        //calificaciones
        foreach(range(10,1) as $p){
            $calificaciones[$p] = count(Calificacion::where('puntaje',$p)->where('juego_id',$juego->id)->get());
            $total += $calificaciones[$p];
        }

        $mis_calificaciones = '';
        if($id_user){
            $mis_calificaciones = Calificacion::where('juego_id',$juego->id)->where('users_id',$id_user)->orderBy('created_at','DESC')->get();

            $calif_users = Calificacion::where('juego_id',$juego->id)->where('users_id', '!=' ,$id_user);
        }else{
            $calif_users = Calificacion::where('juego_id',$juego->id);
        }


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

    /**
     * Aplica los filtros de búsqueda en base a los siguientes valores ante un post, teniendo en cuenta que
     * los nombres de parámetros son case sensitive:
     *  - nombre: String.
     *  - genero_id: Lista formato json.
     *  - plataforma_id: Lista formato json.
     *  - editor_id: Lista formato json.
     *  - desarrollador_id: Lista formato json.
     *  - date: Mas nuevos que esta fecha de lanzamiento.
     *  - date-hasta: mas viejos que esta fecha de lanzamiento (combinado con date aplica un filtro entre ambas fechas).
     *  - orden: ('ASC' | 'DESC') ordena de manera ascendiente o descendiente en base a la fecha de lanzamiento.
     */
    public function busquedaJuego(Request $request){

        //datos para regenerar los filtros
        $generos = Genero::all();
        $plataformas = Plataforma::all();
        $editores = Editor::all();
        $desarrolladores = Desarrollador::all();

        //obtención de input, dinámicamente dentro de un string construyo lo que va luego de 'Juego::'
        //para luego aplicarlo al final.
        $input = $request->all();

        $juegos = null;
        $first=0;
        if(array_key_exists("nombre",$input) && $input["nombre"]){
            if($first == 0){
                $first =1;          //marco el inicio de las consultas y no agrego nada.
                $juegos = Juego::where("nombre","ilike", "%" . $input["nombre"] . "%");
            }else{
                $juegos = $juegos->where("nombre","ilike", "%" . $input["nombre"] . "%");   //encadeno otra llamada.
            }
        }
        if(array_key_exists("generos_id",$input) && $input["generos_id"]){
            $cant = count($input["generos_id"]);
            if($first == 0){
                $juegos = Juego::where("genero",'ilike', "%" . $input["generos_id"][0] . "%");
                for($i = 1; $i<$cant; $i++){
                    $juegos = $juegos->where("genero",'ilike', "%" . $input["generos_id"][$i] . "%");
                }
                $first =1;
            }else{
                for($i = 0; $i<$cant; $i++){
                    $juegos = $juegos->where("genero",'ilike', "%" . $input["generos_id"][$i] . "%");
                }
            }
        }
        if(array_key_exists("plataformas_id",$input) && $input["plataformas_id"]){
            $cant = count($input["plataformas_id"]);
            if($first == 0){
                $juegos = Juego::where("plataforma",'ilike', "%" . $input["plataformas_id"][0] . "%");
                for($i = 1; $i<$cant; $i++){
                    $juegos = $juegos->where("plataforma",'ilike', "%" . $input["plataformas_id"][$i] . "%");
                }
                $first =1;
            }else{
                for($i = 0; $i<$cant; $i++){
                    $juegos = $juegos->where("plataforma",'ilike', "%" . $input["plataformas_id"][$i] . "%");
                }
            }
        }
        if(array_key_exists("editores_id",$input) && $input["editores_id"]){
            $cant = count($input["editores_id"]);
            if($first == 0){
                $juegos = Juego::where("editor",'ilike', "%" . $input["editores_id"][0] . "%");
                for($i = 1; $i<$cant; $i++){
                    $juegos = $juegos->where("editor",'ilike', "%" . $input["editores_id"][$i] . "%");
                }
                $first =1;
            }else{
                for($i = 0; $i<$cant; $i++){
                    $juegos = $juegos->where("editor",'ilike', "%" . $input["editores_id"][$i] . "%");
                }
            }
        }
        if(array_key_exists("desarrolladores_id",$input) && $input["desarrolladores_id"]){
            $cant = count($input["desarrolladores_id"]);
            if($first == 0){
                $juegos = Juego::where("desarrollador",'ilike', "%" . $input["desarrolladores_id"][0] . "%");
                for($i = 1; $i<$cant; $i++){
                    $juegos = $juegos->where("desarrollador",'ilike', "%" . $input["desarrolladores_id"][$i] . "%");
                }
                $first =1;
            }else{
                for($i = 0; $i<$cant; $i++){
                    $juegos = $juegos->where("desarrollador",'ilike', "%" . $input["desarrolladores_id"][$i] . "%");
                }
            }
        }
        if(array_key_exists("date",$input) && $input["date"]){
            if($first == 0){
                if(array_key_exists("date-hasta",$input) && $input["date-hasta"]){
                    $juegos = Juego::whereBetween("fecha_lanzamiento", [$input["date"],$input["date-hasta"]]);
                }else{
                    $juegos = Juego::whereDate("fecha_lanzamiento", '>=', $input["date"]);
                }
                $first =1;
            }else{
                if(array_key_exists("date-hasta",$input) && $input["date-hasta"]){
                    $juegos = $juegos->whereBetween("fecha_lanzamiento", [$input["date"],$input["date-hasta"]]);
                }else{
                    $juegos = $juegos->whereDate("fecha_lanzamiento", '>=', $input["date"]);
                }
            }
        }
        if(array_key_exists("orden",$input) && $input["orden"]){
            if($first == 0){
                $juegos = Juego::orderBy("fecha_lanzamiento", $input["orden"]);
                $first =1;
            }else{
                $juegos = $juegos->orderBy("fecha_lanzamiento", $input["orden"]);
            }
        }

        $filtrado = 1;
        $juegos = $juegos->Paginate(12);

        return view('games',compact('generos','plataformas','editores','desarrolladores','juegos','filtrado'));

    }
}
