<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

            $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                [
                    'email' => 'bail|email|required',
                    'password' => 'bail|required'
                ], [
                    'email.email' => 'El email suministrado no respeta la forma de un email.',
                    'email.required' => 'Se necesita un email.',
                    'password.required' => 'Es necesaria la contraseña para autenticarse.'
                ]
            );

            if ($validator->fails()) {
                $errors = (new \Illuminate\Validation\ValidationException($validator))->errors();
                throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(
                    [
                        'status_code' => 500,
                        'message' => (array_key_exists("email",$errors)) ? $errors["email"][0] : $errors["password"][0]
                    ], \Illuminate\Http\JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
            /* $request->validate([
                'email' => 'bail|email|required',
                'password' => 'bail|required'
            ],[
                'email.email' => 'El email suministrado no respeta la forma de un email.',
                'email.required' => 'Se necesita un email.',
                'password.required' => 'Es necesaria la contraseña para autenticarse.'
            ]); */

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'No se encontro un usuario con el email suministrado, o la contraseña es incorrecta.'
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

    /**
     * Regenera un api_token. Por cuestiones de seguridad vuelvo a requerir los datos de login.
     *
     */
    public function reset(Request $request){
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

            //regenero el token o no.
            if(request('api_token') == $user->api_token){
                $user->api_token = Str::random(80);
                $user->save();
            }else{
                return response()->json([
                    'status_code' => 500,
                    'message' => 'No autorizado'
                ]);
            }



            return response()->json([
                'status_code' => 200,
                'access_token' => $user->api_token,
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
