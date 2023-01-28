<?php
namespace Ciri\DAO\impl;

use Ciri\DAO\ICosmeticosDAO;
use Ciri\DTO\CosmeticoDTO;
use App\Models\Cosmetico;


class CosmeticosDAO implements ICosmeticosDAO{

    public function read():array{

        $cosmeticos = Cosmetico::get()->toArray();

        $cosmeticosresponse = [];

        foreach($cosmeticos as $cosmetico){

            array_push($cosmeticosresponse, new CosmeticoDTO(
                $cosmetico["_id"],
                $cosmetico["id"],
                $cosmetico["category"],
                $cosmetico["name"],
                $cosmetico["sort_description"],
                $cosmetico["big_description"],
                $cosmetico["efficacy"],
                $cosmetico["efficacy_about"],
                $cosmetico["ingredients"],
                $cosmetico["company"],
                $cosmetico["quantity"],
                $cosmetico["price"]
            ));
        }

        return $cosmeticosresponse;
    }

}
