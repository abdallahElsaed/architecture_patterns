<?php

namespace App\Core\Services\Cart;

use App\Core\Domains\Cart;
use App\Core\Services\Product\ProductService;
use App\Core\Services\Discount\DiscountService;
use App\Core\Ports\Cart\CartRepositoryInterface;

class CartService
{

    private ProductService $productService;
    private CartRepositoryInterface $cartRepository; // make binding for this interface in AppServiceProvider
    private DiscountService $discountService;
    public function __construct(CartRepositoryInterface $cartRepository) {
        $this->cartRepository = $cartRepository;
        $this->productService = new ProductService();
        $this->discountService = new DiscountService();
    }

    public function addToCart(int $productId, int $quantity, string $discountCode)
    {
        $userId = auth()->id();
        if (!$this->productService->validateProduct($productId, $quantity)) {
            throw new \Exception('Product is not available in stock.');
        }

        $cartItem = $this->cartRepository->addProductToCart($userId, $productId, $quantity);
        $price = $this->discountService->apply($product->price, $discountCode);

        $cart = Cart::create($productId, $quantity, $price);

        $this->cartRepository->create($cart);
        return [
            'success' => true,
            'message' => 'Product added to cart'
        ];
    }


}
