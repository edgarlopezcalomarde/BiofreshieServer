<?php

namespace App\Http\Controllers;


use Ciri\services\ICosmeticoService;
use Ciri\services\impl\CosmeticoServiceImpl;
use Illuminate\Http\Request;

class CosmeticoController extends Controller
{
    private ICosmeticoService $servicio;
    function __construct()
    {
        $this->servicio =  new CosmeticoServiceImpl();

    }

    public function index()
    {
        return response()->json( $this->servicio->all(), 200);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
