<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Usuario;
use Illuminate\Http\Request;

class CarritoController extends Controller
{

    public function index()
    {
        $carritos = Carrito::get();
        return response()->json($carritos, 200);
    }


    public function store(Request $request)
    {
        $carrito = new Carrito();
        $carrito->cartid = $request->cartid;
        $carrito->cart = $request->cart;
        $carrito->userId = $request->userId;
        $carrito->date = $request->date;
        $carrito->status = $request->status;
        $carrito->totalprice = $request->totalprice;
        $carrito->save();
    }


    public function show($id)
    {
        $carrito = Carrito::get()->where('cartid',$id);
        return $carrito;
    }

    public function searchByCartId($id){
        $carrito  = Carrito::get()->where('cartid',$id);
        return response()->json($carrito, 200);
    }

    public function searchByUserId($id){
        $usuarioCarrito  = Carrito::get()->where('userId',$id);
        return response()->json($usuarioCarrito, 200);
    }

    //Request = body y Parametro = $id
    public function update(Request $request, $id){
        $carrito = Carrito::findOrFail($id);
        $carrito->cartid = $request->cartid;
        $carrito->cart = $request->cart;
        $carrito->userId = $request->userId;
        $carrito->date = $request->date;
        $carrito->status = $request->status;
        $carrito->totalprice = $request->totalprice;
        $carrito->save();
        return [ "id"=> $id, "carrito"=> $carrito, "request"=>$request->status];

    }


    public function destroy($id){
       Carrito::destroy($id);
       return response()->json(["message"=>"borrado la id: $id"], 200);
    }
}
