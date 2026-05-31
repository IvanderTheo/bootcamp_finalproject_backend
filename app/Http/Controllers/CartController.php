<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Cart;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;

class CartController extends Controller
{
    //
    public function index() {
        $result = Cart::with('cartItems')->where('status','active')->get();
        return response()->json([
            'status'=>'success',
            'message'=>'Success Retrieved Cart',
            'data'=>$result,
        ]);
    }
    public function show($id) {
        $result = Cart::with('cartItems')->findOrFail($id);
        return response()->json([
            'status'=>'success',
            'message'=>'Success Retrived Cart Item',
            'data'=>$result,
        ]);
    }

    public function addToCart(Request $request, CartService $cartService)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                    function ($attribute, $value, $fail) use ($request) {

                        $product = Product::find($request->product_id);

                        if ($product && $value > $product->stock) {
                            $fail('Quantity melebihi stok.');
                        }
                    }
                ]
            ]);

            DB::transaction(function() use ($request, $cartService) {
                $product = Product::findOrFail($request->product_id);
                $cart = Cart::firstOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'status' => 'active'
                    ],
                    [
                        'total_price' => 0
                    ]
                );

                $subtotal = $cartService->calculateSubtotal(
                    $product->price,
                    $request->quantity
                );

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ]);

                // update total cart
                $cartService->updateCartTotal($cart);

            });

            return response()->json([
                'status' => 'success',
                'message' => 'Success Add Item'
            ]);

        } catch(Exception $e){

            return response()->json([
                'status' => 'failed',
                'message' => 'Add to cart failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    //delete
    public function delete($id) {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'cart deleted'
        ]);
    }
}
