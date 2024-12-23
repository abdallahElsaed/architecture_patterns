<?php

namespace App\Core\Ports\Cart;

use App\Core\Domains\Cart;

interface CartRepositoryInterface
{
    public function addProductToCart($userId, $productId, $quantity);
}
