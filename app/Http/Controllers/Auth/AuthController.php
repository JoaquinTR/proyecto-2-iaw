<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Por las dudas.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Autentica un usuario por post, y retorna su api_token en caso de validar.
     *
     */
    public function login(Request $request){
        try {

            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ],[
                'email.email' => 'El email suministrado no respeta la forma de un email.',
                'email.required' => 'Se necesita un email.',
                'password.required' => 'Es necesaria la contraseña para autenticarse.'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'No autorizado'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error en el login');
            }

            //devuelvo el token para que el usuario lo utilice con la api
            //se debe agregar un header que contenga "Authorization" => "Bearer "
            //y el token detrás (notar el espacio luego de Bearer)
            $tokenResult = $user->api_token;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error en el login',
                'error' => $error,
            ]);
        }
    }
}
