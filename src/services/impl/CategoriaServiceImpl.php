<?php
namespace Ciri\services\impl;

use Ciri\DAO\impl\CategoriasDAO;
use Ciri\services\ICategoriaService;

class CategoriaServiceImpl implements ICategoriaService {

    public function all():array{
        $categoriasDao = new CategoriasDAO();
        return  $categoriasDao->read();
    }

}
