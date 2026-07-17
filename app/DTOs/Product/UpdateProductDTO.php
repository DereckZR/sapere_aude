<?php

namespace App\DTOs\Product;

class UpdateProductDTO
{
    public int $id;
    public ?String $name;
    public ?String $description;
    public ?Float $price;
    public ?Int $stock_quantity;
    public ?Float $author_comission_percentage;

    public function __construct(
        public readonly array $data
    ) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->stock_quantity = $data['stock_quantity'];
        $this->author_comission_percentage = $data['author_comission_percentage'];
    }
}
