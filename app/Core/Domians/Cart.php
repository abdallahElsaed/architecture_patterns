<?php

namespace App\Core\Domains;

class Cart
{
    private int $id;
    private int $product_id;
    private int $quantity;
    private float $price;

    public function __construct( int $product_id, int $quantity, float $price)
    {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public static function create(int $product_id, int $quantity, float $price): self
    {
        return new self( $product_id, $quantity, $price);
    }
}
