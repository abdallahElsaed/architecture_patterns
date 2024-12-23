
<?php

namespace App\Shell\Http\Controllers;

use Illuminate\Http\Request;
use App\Shell\Http\Controllers\Controller;
use App\Core\Services\Cart\CartService;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $discountCode = $request->input('discountCode') ?? '';

        try {
            $cartItem = $this->cartService->addToCart($productId, $quantity, $discountCode);
            return response()->json($cartItem, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
