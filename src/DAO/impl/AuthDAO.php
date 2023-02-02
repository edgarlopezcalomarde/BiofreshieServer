<?php

namespace Ciri\DAO\impl;

use Ciri\DAO\IAuthDAO;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;



class AuthDAO implements IAuthDAO
{

    public function login(Request $request): array
    {
        $credenciales = $request->validate([
            'nick' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credenciales)){
            $usuario = Auth::user();
            $token = Auth::login($usuario); //almacen a el _id del usuario y lo mete como subject en el token

            return [
                "token"=> $token,
                'id' => $usuario->id,
                'mail' => $usuario->mail,
                'nick' => $usuario->nick,
                "responsetype" => Response::HTTP_OK
            ];

        }else{
            return ["message" => "Credenciales Invalidas" , "responsetype" => Response::HTTP_FORBIDDEN] ;
        }

    }

    public function register(Request $request): array
    {

        $validator = Validator::make($request->all(), [
            'mail' => 'required',
            'nick' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $usuario = new Usuario();
        $usuario->id = uniqid();
        $usuario->mail = $request->mail;
        $usuario->nick = $request->nick;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $token = Auth::login($usuario);

        return [
            "token "=> $token,
            "usuario" => $usuario
        ];
    }


    public function userProfile(){
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user()
        ], 200);
    }

    public function logOut(): bool{

        $token = Auth::getToken();
        $payload = Auth::getPayload($token)->toArray();

        echo "Nos veremos en otra oacasion " . $payload["nick"];

        Auth::logout();
        return true;
    }
}
