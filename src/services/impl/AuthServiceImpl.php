<?php
namespace Ciri\services\impl;

use Ciri\DAO\IAuthDAO;
use Ciri\DAO\impl\AuthDAO;
use Ciri\services\IAuthService;
use Illuminate\Http\Request;

class AuthServiceImpl implements IAuthService {

    private IAuthDAO $auth;

    function __construct()
    {
        $this->auth = new AuthDAO();
    }

    public function login(Request $request):array{
        return $this->auth->login($request);
    }

    public function register(Request $request):bool{
        return $this->auth->register($request);
    }

    public function logout():bool{
        return $this->auth->logout();
    }

}
