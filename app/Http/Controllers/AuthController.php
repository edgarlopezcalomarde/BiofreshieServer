<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Ciri\services\IAuthService;
use Ciri\services\impl\AuthServiceImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    private IAuthService $servicio;
    function __construct()
    {
        $this->servicio = new AuthServiceImpl();
    }

    function login(Request $request){
        $response = $this->servicio->login($request);
        return response()->json($response, $response["responsetype"]);
    }

    function register(Request $request){
        return  $this->servicio->register($request);
    }

    public function logOut(){
        return  $this->servicio->logOut();
    }

}
