<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Usuario;
use Ciri\services\ICarritoService;
use Ciri\services\impl\CarritoServiceImpl;
use Illuminate\Http\Request;

class CarritoController extends Controller
{


    private ICarritoService $servicio;
    function __construct()
    {
        $this->servicio = new CarritoServiceImpl();
    }

    public function index()
    {
        return response()->json($this->servicio->all(), 200);
    }


    public function store(Request $request)
    {
       $this->servicio->insert($request);
    }

    public function show($id)
    {
        return response()->json($this->servicio->find($id), 200);
    }

    public function searchByCartId($id){
        return response()->json($this->servicio->find($id), 200);
    }

    public function searchByUserId($id){
        return response()->json($this->servicio->findByUser($id), 200);
    }

    //Request = body y Parametro = $id
    public function update(Request $request, $id){

        return  $this->servicio->update($request,$id);
    }

    public function destroy($id){
        $this->servicio->delete($id);
       return response()->json(["message"=>"borrado la id: $id"], 200);
    }
}
