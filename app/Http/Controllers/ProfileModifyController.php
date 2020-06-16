<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileModifyController extends Controller
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
        return view('profile.datos');
    }

    /**
     * Tomar datos de nombre de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeName(Request $request)
    {
        // Obtener el usuario actual
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $request->validate(
            [
                'name' => 'required|min:5'
            ],
            [
                'name.required' => 'Se necesita un nombre.',
                'name.min' => 'El nombre debe tener al menos 5 caracteres.'
            ]);

        $input = $request->all();

        // Lleno el modelo de usuario
        $user->fill([
            'name' => $input['name']
        ]);

        // Grabo en la base de datos
        $user->save();

        return back()->with('success', 'Datos modificados correctamente.');
    }

    /**
     * Tomar datos de email de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeEmail(Request $request)
    {
        // Obtener el usuario actual
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $request->validate(
            [
                'email' => 'required|email|unique:users'
            ],
            [
                'email.required' => 'Por favor ingrese un email.',
                'email.email' => 'Por favor ingrese un email.',
                'email.unique' => 'El email ya está regristrado.'
            ]);

        $input = $request->all();

        // Lleno el modelo de usuario
        $user->fill([
            'email' => $input['email']
        ]);

        // Grabo en la base de datos
        $user->save();

        return back()->with('success', 'Datos modificados correctamente.');
    }
}
