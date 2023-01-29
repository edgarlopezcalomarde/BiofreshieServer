<?php
namespace Ciri\DAO\impl;
use App\Models\Categoria;
use Ciri\DAO\ICategoriasDAO;
use Ciri\DTO\CategoriaDTO;

class CategoriasDAO implements ICategoriasDAO{

    public function read():array{

        $categorias =  Categoria::get()->toArray();

        $response = [];

        foreach($categorias as $categoria){

            array_push($response, new CategoriaDTO(
                $categoria["_id"],
                $categoria["id"],
                $categoria["nombre"]
            ));
        }

        return $response;
    }

}
