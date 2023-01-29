<?php

namespace Ciri\services;

use Illuminate\Http\Request;

interface IAuthService {
    public function login(Request $request):array;
    public function register(Request $request):bool;
    public function logout():bool;
}
