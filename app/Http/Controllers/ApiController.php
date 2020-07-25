<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Juego;
use App\Calificacion;
use App\Genero;
use App\Plataforma;
use App\Editor;
use App\Desarrollador;
use App\Pedido;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //Pagina todos los juegos en tandas de 50
    public function allJuegos(){
        try {

            $juegos = Juego::select('id','nombre','genero','fecha_lanzamiento','descripcion','plataforma','editor','desarrollador','puntaje','cant_calificaciones','rating')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $juegos
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los juegos: '.$error->getMessage()
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allCalificaciones(){
        try {

            $calificaciones = Calificacion::select('id','users_id','juego_id','reseña','descripcion','puntaje','tipo')->Paginate(50);

            return response()->json([
                'status_code' => 200,
                'response' => $calificaciones
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los juegos: '.$error->getMessage()
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allGeneros(){
        try {

            $generos = Genero::select('id','nombre')->get();

            return response()->json([
                'status_code' => 200,
                'response' => $generos
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los géneros: '.$error->getMessage()
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allPlataformas(){
        try {

            $plataformas = Plataforma::select('id','nombre')->get();

            return response()->json([
                'status_code' => 200,
                'response' => $plataformas
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener las plataformas: '.$error->getMessage()
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allEditores(){
        try {

            $editores = Editor::select('id','nombre')->get();

            return response()->json([
                'status_code' => 200,
                'response' => $editores
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los editores: '.$error->getMessage()
            ]);
        }
    }

    //Pagina todos los juegos en tandas de 50
    public function allDesarrolladores(){
        try {

            $desarrolladores = Desarrollador::select('id','nombre')->get();

            return response()->json([
                'status_code' => 200,
                'response' => $desarrolladores
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los desarrolladores: '.$error->getMessage()
            ]);
        }
    }

    //Entrega los pedidos de un usuario.
    public function misPedidos(Request $request){
        try {

            $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'users_id' => 'required',
                ], [
                    'users_id.required' => 'Por favor, envíe el id del usuario.'
                ]
            );

            if ($validator->fails()) {
                $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
                throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                    [
                        'status_code' => 500,
                        'message' => (array_key_exists("users_id",$errors)) ? $errors["users_id"][0] : "Ocurrió un error inesperado"
                    ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }

            $id = $request->users_id;

            $pedidos = Pedido::select('id','nombre','genero','fecha_lanzamiento', 'descripcion','plataforma','editor','desarrollador','created_at')->where('users_id',$id)->get();

            return response()->json([
                'status_code' => 200,
                'response' => $pedidos
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al obtener los pedidos: '.$error->getMessage()
            ]);
        }
    }

    //Crea un nuevo pedido en base a los datos ingresados por el usuario.
    public function createPedido(Request $request){
        try {

            $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'users_id' => 'required',
                    'fecha_lanzamiento' => 'required',
                    'desarrollador' => 'required',
                    'descripcion' => 'required|min:20',
                    'editor' => 'required',
                    'genero' => 'required',
                    'nombre' => 'required|unique:juego',
                    'plataforma' => 'required'
                ], [
                    'users_id.required' => 'users_id: Por favor, envíe el id del usuario.',
                    'fecha_lanzamiento.required' => 'fecha_lanzamiento: Ingrese al menos una fecha.',
                    'desarrollador.required' => 'desarrollador: Ingrese al menos un desarrollador.',
                    'descripcion.required' => 'descripcion: Ingrese al menos una descripción de 20 caracteres.',
                    'descripcion.min' => 'descripcion: La descripción debe tener al menos 20 caracteres.',
                    'editor.required' => 'editor: Ingrese al menos un editor.',
                    'genero.required' => 'genero: Ingrese al menos un genero.',
                    'nombre.required' => 'nombre: Ingrese al menos un nombre.',
                    'nombre.unique' => 'nombre: El juego ya existe, compruebe nuestra página.',
                    'plataforma.required' => 'plataforma: Ingrese al menos una plataforma.',
                ]
            );

            if ($validator->fails()) {
                $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
                throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                    [
                        'status_code' => 500,
                        'message' => ($errors) ? $errors : "Ocurrió un error inesperado"
                    ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }

            $id = $request->users_id;

            $pedido = new Pedido;

            $pedido->nombre = $request->nombre;
            $pedido->users_id = $request->users_id;
            $pedido->genero = $request->genero;
            $pedido->fecha_lanzamiento = $request->fecha_lanzamiento;
            $pedido->descripcion = $request->descripcion;
            $pedido->plataforma = $request->plataforma;
            $pedido->editor = $request->editor;
            $pedido->desarrollador = $request->desarrollador;
            $pedido->created_at = now();
            $pedido->updated_at = now();

            $pedido->save();

            return response()->json([
                'status_code' => 200,
                'response' => "Pedido creado correctamente",
                'datos' => $request->all()
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al crear el pedido: '.$error->getMessage()
            ]);
        }
    }

    //Elimina pedido en base a los datos ingresados por el usuario.
    public function deletePedido(Request $request){
        try {

            $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'users_id' => 'required',
                    'pedido_id' => 'bail|required|exists:pedido,id'
                ], [
                    'users_id.required' => 'Por favor, envíe el id del usuario.',
                    'pedido_id.required' => 'Por favor, envíe el id del pedido.',
                    'pedido_id.exists' => 'No existe el pedido indicado.'
                ]
            );

            if ($validator->fails()) {
                $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
                throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                    [
                        'status_code' => 500,
                        'message' => (array_key_exists("users_id",$errors)) ? $errors["users_id"][0] : $errors["pedido_id"][0]
                    ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }

            $pedido_id = $request->pedido_id;

            $pedido = Pedido::findOrFail($pedido_id);

            $pedido->delete();

            return response()->json([
                'status_code' => 200,
                'response' => "Pedido eliminado correctamente",
                'pedido'=>$pedido
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al eliminar el pedido: '.$error->getMessage()
            ]);
        }
    }

    //Actualiza pedido en base a los datos ingresados por el usuario.
    public function updatePedido(Request $request){
        try {

            $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'users_id' => 'required',
                    'fecha_lanzamiento' => 'required',
                    'desarrollador' => 'required',
                    'descripcion' => 'required|min:20',
                    'editor' => 'required',
                    'genero' => 'required',
                    'nombre' => 'required',
                    'plataforma' => 'required',
                    'pedido_id' => 'bail|required|exists:pedido,id'
                ], [
                    'users_id.required' => 'users_id: Por favor, envíe el id del usuario.',
                    'fecha_lanzamiento.required' => 'fecha_lanzamiento: Ingrese al menos una fecha.',
                    'desarrollador.required' => 'desarrollador: Ingrese al menos un desarrollador.',
                    'descripcion.required' => 'descripcion: Ingrese al menos una descripción de 20 caracteres.',
                    'descripcion.min' => 'descripcion: La descripción debe tener al menos 20 caracteres.',
                    'editor.required' => 'editor: Ingrese al menos un editor.',
                    'genero.required' => 'genero: Ingrese al menos un genero.',
                    'nombre.required' => 'nombre: Ingrese al menos un nombre.',
                    'plataforma.required' => 'plataforma: Ingrese al menos una plataforma.',
                    'pedido_id.required' => 'Por favor, envíe el id del pedido.',
                    'pedido_id.exists' => 'No existe el pedido indicado.'
                ]
            );

            if ($validator->fails()) {
                $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
                throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                    [
                        'status_code' => 500,
                        'message' => ($errors) ? $errors : "Ocurrió un error inesperado"
                    ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }

            $pedido_id = $request->pedido_id;

            $pedido = Pedido::findOrFail($pedido_id);

            $pedido->nombre = $request->nombre;
            $pedido->users_id = $request->users_id;
            $pedido->genero = $request->genero;
            $pedido->fecha_lanzamiento = $request->fecha_lanzamiento;
            $pedido->descripcion = $request->descripcion;
            $pedido->plataforma = $request->plataforma;
            $pedido->editor = $request->editor;
            $pedido->desarrollador = $request->desarrollador;
            $pedido->updated_at = now();

            $pedido->save();

            return response()->json([
                'status_code' => 200,
                'response' => "Pedido creado correctamente",
                'datos' => $request->all()
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error al crear el pedido: '.$error->getMessage()
            ]);
        }
    }
}
