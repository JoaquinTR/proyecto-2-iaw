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
        $users = User::all();
        return view('dashboard.allUsers',compact('users'));
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
}
