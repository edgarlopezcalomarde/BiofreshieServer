<?php
namespace Ciri\DTO;

class UserDTO{

    function __construct(
        private ?string $_id,
        private ?string $id,
        private string $category,
        private string $name,
        private string $sort_description,
        private string $big_description,
        private string $efficacy,
        private string $efficacy_about,
        private string $ingredients,
        private string $company,
        private int $quantity,
        private int $price,
        )
    {

       $this->_id = $_id;
       $this->id = $id;
       $this->category = $category;
       $this->name = $name;
       $this->sort_description = $sort_description;
       $this->big_description = $big_description;
       $this->efficacy = $efficacy;
       $this->efficacy_about = $efficacy_about;
       $this->ingredients = $ingredients;
       $this->company = $company;
       $this->quantity = $quantity;
       $this->price = $price;

    }





}
