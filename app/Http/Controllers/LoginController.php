<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{


    function login(Request $request){

        date_default_timezone_set('Europe/Madrid');

        $usuario = Usuario::where('nick', $request->nick)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)){
            return response()->json(['error' => 'Credenciales no válidas'], 401);
        }else{

            $userToken = Usuario::where('usuario_id', $usuario->id)->first();

            if(!$userToken){
                $token = new Token();
                $token->usuario_id = $usuario->id;
                $token->token = Str::random(60);
                $token->expires_in = date('Y-m-d H:i:s', strtotime("now + 1000 seconds"));
                $token->save();

                return response()->json([
                    'token' => $token->token,
                    'id' => $usuario->id,
                    'mail' => $usuario->mail,
                    'nick' => $usuario->nick
                ]);
            }

            return response()->json([
                'token' => $userToken->token,
                'id' => $usuario->id,
                'mail' => $usuario->mail,
                'nick' => $usuario->nick
            ]);
        }


        // date_default_timezone_set('Europe/Madrid');


        // if(password_verify($user->password(), $db_data->password)){

        //     $access_token = password_hash(rand(), PASSWORD_DEFAULT, ['cost' => 15]);
        //     $refresh_token = password_hash(rand(), PASSWORD_DEFAULT, ['cost' => 15]);


        //     $expiresTime= strtotime("now + 600 seconds");
        //     $refreshTime = strtotime("now + 5 days");
        //     $access_token_expires_in =  date('Y-m-d H:i:s', $expiresTime);
        //     $refresh_token_expires_in = date('Y-m-d H:i:s', $refreshTime);

        //     DB::table("usuarios")->update([
        //         'id' => $db_data->id,
        //         'logued' => true,
        //     ]);

        //     DB::table("tokens")->insertOnDuplicate([
        //         'id_usuario' => $db_data->id,
        //         'token' => $access_token,
        //         'expires_in' =>  $access_token_expires_in
        //     ],
        //     [
        //         'token' => $access_token,
        //         'expires_in' =>  $access_token_expires_in
        //     ]);

        //     DB::table("tokens_refresco")->insert([
        //         'id_usuario' => $db_data->id,
        //         'token' =>  $refresh_token,
        //         'expires_in' =>  $refresh_token_expires_in,
        //         'activo' => true
        //     ]);



        //     $data = [
        //         "userId" => $db_data->id,
        //         "tokenDeAcceso" => $access_token,
        //         "tokenDeRefresco" => $refresh_token,
        //         "statusMessage" => "Already logued",
        //         "status" => 200
        //     ];


        //     return  $data;
        // }else{
        //     $data = ([
        //         "error" => "No se ha podido iniciar sesion en la app intentelo de nuevo",
        //         "status" => 401
        //     ]);

        //     return $data;
        // }

    }

    function register(Request $request){
        $usuario = new Usuario();
        $usuario->id = uniqid();
        $usuario->mail = $request->mail;
        $usuario->nick = $request->nick;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
    }




    // function singOut($id):array{

    //     $result = DB::table("usuarios")->update([
    //         'id' => $id,
    //         'logued' => false
    //     ]);


    //     if($result){
    //         $data = ([
    //             "message" => "Sesion cerrada",
    //             "status" => 200
    //         ]);

    //     }else{
    //         $data = ([
    //             "message" => "No es posible realizar la peticion",
    //             "status" => 400
    //         ]);

    //     }
    //     return $data;
    // }




    // function checkToken($token):array{

    //     $tokenInfo = DB::table('tokens')
    //     ->select("*")
    //     ->where(['token', '=', $token])
    //     ->getOne();


    //     if($tokenInfo){
    //         $now = strtotime("now");

    //         if($now < $tokenInfo->expires_in){

    //            $data = ([
    //                 "Tokendata" => $tokenInfo,
    //                 "Status" => 200
    //             ]);

    //         }else{
    //             $data = ([
    //                 "Error" => "Token expirado",
    //                 "Status" => 401
    //             ]);
    //         }


    //     }else{
    //         $data = ([
    //             "Error" => "Token inválido",
    //             "Status" => 401
    //         ]);
    //     }

    //     return  $data;
    // }


}
