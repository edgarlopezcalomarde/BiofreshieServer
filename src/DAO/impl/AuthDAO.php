<?php

namespace Ciri\DAO\impl;

use Ciri\DAO\IAuthDAO;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Token;
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
            $token = $usuario->createToken('token')->plainTextToken; //Da que falla pero va lo que pasa esque no te inserta el expires porque es un perro

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

    public function register(Request $request): bool
    {

        $validator = Validator::make($request->all(), [
            'mail' => 'required',
            'nick' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return false;
            // return response()->json($validator->errors());
        }

        $usuario = new Usuario();
        $usuario->id = uniqid();
        $usuario->mail = $request->mail;
        $usuario->nick = $request->nick;
        $usuario->password = bcrypt($request->password);
        return $usuario->save();
    }


    public function userProfile(){
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user()
        ], 200);
    }

    public function logOut(): bool{
        $usuarioAutenticado = Auth::user();
        Token::where('tokenable_id', $usuarioAutenticado->_id)->delete();
        return true;
    }
}
