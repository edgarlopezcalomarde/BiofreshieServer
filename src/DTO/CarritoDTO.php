<?php

namespace Ciri\DTO;
use JsonSerializable;

class CarritoDTO implements JsonSerializable
{

    function __construct(
        private ?string $_id,
        private string $cartid,
        private array $cart,
        private string $userId,
        private string $date,
        private string $status,
        private int $totalprice
    ){

        $this->_id = $_id;
        $this->cartid = $cartid;
        $this->cart = $cart;
        $this->userId = $userId;
        $this->date = $date;
        $this->status = $status;
        $this->totalprice = $totalprice;
    }


    function jsonSerialize(): mixed {
        return [
            '_id' => $this->_id,
            'cartid' => $this->cartid,
            'cart' => $this->cart,
            'userId' => $this->userId,
            'date' => $this->date,
            'status' => $this->status,
            'totalprice' => $this->totalprice
        ];
    }
}
