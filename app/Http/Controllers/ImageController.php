<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Image;

use Img;

class ImageController extends Controller
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
     * Mostrar todas las imágenes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.allImages');
    }

    /**
     * Muestra por pantalla la imágen seleccionada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verImagen(Request $request, $id)
    {
        $imagen = Image::select('imagen')->findOrFail($id);
        return $imagen;
    }

    /**
     * Muestra el formulario de carga de una imagen nueva.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function newImage(){
        return view('dashboard.newImage');
    }

    /**
     * Toma los datos que ingresó el administrador y los carga en la base de datos de juegos.
     *
     * @return \Illuminate\Http\Response
     */
    public function newImageCreate(Request $request){

        $request->validate(
            [
                'nombre' => 'required',
                'juego_id' => 'required|exists:juego,id',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ],
            [
                'nombre.required' => 'Se necesita un nombre para la imagen, que identifique el propósito.',
                'juego_id.required' => 'Por favor indique el juego al que corresponde (ver tabla juegos).',
                'juego_id.exists' => 'El id del juego ingresado no existe en la base de datos.',
                'imagen.required' => 'No cargó una imágen.'
            ]);
            $input = $request->all();
            $image_file = $input["imagen"];
            if($request->hasFile('imagen')){
                $foto = base64_encode(file_get_contents($request->file('imagen')));
            }

            $i = new Image;

            $i->nombre_vista = $input["nombre"];
            $i->juego_id = $input["juego_id"];
            $i->imagen = $foto;
            $i->created_at = now();
            $i->updated_at = now();
            $i->save();

            return redirect(route('dashboard.image.all'))->with('success', 'Imagen cargada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Image::findOrFail($id);
        $imagen->delete();

        return redirect(route('dashboard.image.all'))->with('success', 'Se ha eliminado correctamente la imágen.');
    }

    /**
     * Retorna las imágnes (sin los datos de imagen) ante una consulta ajax.
     */
    public function ajaxImagenes(Request $request){
        if($request->ajax()){
            $imagenes = Image::all('id','nombre_vista','juego_id');
            return \Response::json($imagenes);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
