<?php

namespace App\Shell\Infrastructure\Repositories\Product;

use App\Shell\Models\ProductModel;
use Illuminate\Support\Collection;
use App\Core\Ports\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function isAvailable(int $id, int $quantity)
    {
        $product = ProductModel::find($id);
        return $product && $product->stock >= $quantity;
    }
}
