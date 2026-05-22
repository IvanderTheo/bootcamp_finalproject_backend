<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleDetails;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Carts;
use Exception;

class SaleController extends Controller
{
    //
    public function checkout(Request $request)
    {
        try {

            $validated = $request->validate([
                'cart_id' => 'required|exists:carts,id'
            ]);

            DB::transaction(function() use ($validated) {

                // ambil cart user yang sedang login
                $cart = Carts::with('cartItem')
                    ->where('id', $validated['cart_id'])
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

                // pastikan cart tidak kosong
                if ($cart->items->isEmpty()) {
                    throw new Exception('Cart kosong');
                }

                // cek stok ulang
                foreach ($cart->items as $item) {
                    $product = Products::find($item->product_id);
                    
                    if ($product->stock < $item->quantity) {
                        throw new Exception(
                            "{$product->product_name} stok tidak cukup"
                        );
                    }
                }

                // buat sale
                $sale = Sales::create([
                    'user_id' => auth()->id(),
                    'invoice_number' => 'INV'.time(),
                    'total_amount' => $cart->total_price,
                    'grand_total' => $cart->total_price,
                    'status' => 'pending'
                ]);

                // simpan detail
                foreach ($cart->items as $item) {

                    SaleDetails::create([
                        'sale_id' => $sale->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price
                    ]);

                    // kurangi stok
                    Products::where(
                        'id',
                        $item->product_id
                    )->decrement(
                        'stock',
                        $item->quantity
                    );
                }

                // ubah cart selesai
                $cart->update([
                    'status' => 'checked_out'
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Checkout berhasil'
            ]);

        } catch(Exception $e){

            return response()->json([
                'status' => 'failed',
                'message' => 'Checkout gagal',
                'error' => $e->getMessage()
            ],500);
        }
    }
}
