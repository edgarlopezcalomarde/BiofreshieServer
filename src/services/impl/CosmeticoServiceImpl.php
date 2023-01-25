<?php
namespace Ciri\services\impl;

use Ciri\DAO\ICosmeticosDAO;
use Ciri\DAO\impl\CosmeticosDAO;
use Ciri\services\ICosmeticoService;

class CosmeticoServiceImpl implements ICosmeticoService {



    public function all():array{
        $cosmeticosDao = new CosmeticosDAO();
        return  $cosmeticosDao->read();
    }

}
