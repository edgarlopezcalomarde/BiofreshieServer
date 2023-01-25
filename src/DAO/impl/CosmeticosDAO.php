<?php
namespace Ciri\DAO\impl;

use Ciri\DAO\ICosmeticosDAO;
use App\Models\Cosmetico;

class CosmeticosDAO implements ICosmeticosDAO{

    public function read():array{

        $cosmeticos = Cosmetico::get()->toArray();
        return $cosmeticos;
    }

}
