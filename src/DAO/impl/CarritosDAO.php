<?php
namespace Ciri\DAO\impl;

use App\Models\Carrito;
use Ciri\DAO\ICarritosDAO;
use Ciri\DTO\CarritoDTO;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class CarritosDAO implements ICarritosDAO{

    public function read():array{


        $carritos =  Carrito::get()->toArray();

        $response = [];

        foreach($carritos as $carrito){

            array_push($response, new CarritoDTO(
                $carrito["_id"],
                $carrito["cartid"],
                $carrito["cart"],
                $carrito["userId"],
                $carrito["date"],
                $carrito["status"],
                $carrito["totalprice"]
            ));
        }

        return $response;

    }


    public function findById(string $id): CarritoDTO{

        $carritoAll = Carrito::all()->where('cartid',$id)->toArray();
        $carrito = [];
        foreach($carritoAll as $pedido){

            if($pedido["cartid"] == $id){
                $carrito = $pedido;
            }
        }

        return new CarritoDTO(
            $carrito["_id"],
            $carrito["cartid"],
            $carrito["cart"],
            $carrito["userId"],
            $carrito["date"],
            $carrito["status"],
            $carrito["totalprice"]
        );


    }


    public function findByUser(string $id): array{

        $carritoAll = Carrito::all()->where('userId',$id)->toArray();
        $carrito = [];

        foreach($carritoAll as $pedido){

            if($pedido["userId"] == $id){

                array_push($carrito,
                new CarritoDTO(
                    $pedido["_id"],
                    $pedido["cartid"],
                    $pedido["cart"],
                    $pedido["userId"],
                    $pedido["date"],
                    $pedido["status"],
                    $pedido["totalprice"]
                ));
            }
        }


        try{

            return $carrito;

        }catch(Throwable  $e){
            throw new NotFoundHttpException();
            //throw new Exception();
        }


    }

    public function delete(string $id): bool{
        return Carrito::destroy($id);
    }

    public function create(Request $request): bool{
        $carrito = new Carrito();
        $carrito->cartid = $request->cartid;
        $carrito->cart = $request->cart;
        $carrito->userId = $request->userId;
        $carrito->date = $request->date;
        $carrito->status = $request->status;
        $carrito->totalprice = $request->totalprice;

        return $carrito->save();
    }

    public function update(Request $request, $id): array{
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

}
