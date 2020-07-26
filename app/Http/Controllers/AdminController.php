<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Devuelve la vista de todos los usuarios.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allUsers(){
        return view('dashboard.allUsers');
    }

    /**
     * Convierte a un usuario en admin.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminificar($id){
        $user = User::findOrFail($id);
        $user->type = "admin";
        $user->updated_at = now();
        $user->save();
        return redirect(route('dashboard.usuarios'))->with('success', 'Se ha convertido el usuario en administrador correctamente.');
    }

    /**
     * Retorna los usuarios ante una consulta ajax.
     */
    public function ajaxUsers(Request $request){
        if($request->ajax()){
            $users = User::all();
            return \Response::json($users);
        }
        else{
            return back()->with('error', 'Accesso denegado.');
        }
    }
}
