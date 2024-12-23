<?php

namespace App\Core\Ports\Product;


interface ProductRepositoryInterface
{
    public function isAvailable(int $id, int $quantity);
}
