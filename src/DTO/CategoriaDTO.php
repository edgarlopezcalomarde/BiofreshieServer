<?php
namespace Ciri\DTO;
use JsonSerializable;

class CategoriaDTO implements JsonSerializable
{

    function __construct(
        private ?string $_id,
        private ?string $id,
        private string $category,
    )
    {
        $this->_id = $_id;
        $this->id = $id;
        $this->category = $category;
    }


    function jsonSerialize(): mixed {
        return [
            '_id' => $this->_id,
            'id' => $this->id,
            'category' => $this->category
        ];
    }
}
