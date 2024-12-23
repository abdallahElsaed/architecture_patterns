<?php

namespace App\Core\Services\Product;

use App\Core\Domains\Product;
use App\Core\Ports\Product\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function validateProduct(int $id, int $quantity)
    {
        return $this->productRepository->isAvailable($id, $quantity);
    }
}
