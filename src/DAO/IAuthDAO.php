<?php
namespace Ciri\DAO;
use Illuminate\Http\Request;

interface IAuthDAO {
    public function login(Request $request):array;
    public function register(Request $request):array;
    public function logout():bool;
}
