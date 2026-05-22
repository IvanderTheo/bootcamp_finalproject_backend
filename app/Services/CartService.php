<?php

namespace App\Services;

use App\Models\CartItems;
use Brick\Math\BigDecimal;
use Ramsey\Uuid\Type\Decimal;

class CartService {
    public function calculateSubtotal($price, $quantity)
    {
        return $price * $quantity;
    }

    public function updateCartTotal($cart)
    {
        $total = CartItems::where('cart_id', $cart->id)
            ->sum('subtotal');

        $cart->update([
            'total_price' => $total
        ]);

        return $total;
    }
}
