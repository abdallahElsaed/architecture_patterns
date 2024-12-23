<?php

namespace App\Core\Domains;

class Product
{
    private string $id;
    private string $name;
    private int $quantity;
    private float $price;
    private bool $in_stock;

    public function __construct(int $id, string $name, int $quantity, float $price, bool $in_stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->in_stock = $in_stock;
    }

    public static function create(int $id, string $name, int $quantity, float $price, bool $in_stock): self
    {
        return new self($id, $name, $quantity, $price, $in_stock);
    }
}
