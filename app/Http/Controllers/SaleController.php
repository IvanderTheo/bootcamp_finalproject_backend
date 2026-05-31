<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Exception;

class SaleController extends Controller
{
    //
    public function index () {
        try {
            $result = Sale::latest();
            return response()->json([
                'status'=>'success',
                'message'=>'success retrieved data',
                'data'=>$result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'message'=>'failed received data',
                'error'=>$e->getMessage(),
            ]);
        }
    }
    public function show ($id) {
        try {
            $result = Sale::with('saleDetail')->findOrFail($id);
            return response()->json([
                'status'=>'success',
                'message'=>'success retrieved data',
                'data'=>$result
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'failed',
                'message'=>'failed received data',
                'error'=>$e->getMessage(),
            ]);
        }
    }
    public function checkout(Request $request)
    {
        try {
            $validated = $request->validate([
                'cart_id' => 'required|exists:carts,id',
                'table_id'=>'required|integer|exists:tables,table_id',
                'capacity'=>'required|integer',
            ]);

            DB::transaction(function() use ($validated) {

                // ambil cart user yang sedang login
                $cart = Cart::with('cartItems.product')
                    ->where('id', $validated['cart_id'])
                    ->where('user_id', auth()->id())
                    ->firstOrFail();
                // pastikan cart tidak kosong
                if ($cart->cartItems->isEmpty()) {
                    throw new Exception('Cart kosong');
                }

                // cek stok ulang
                foreach ($cart->cartItems as $item) {

                    if (!$item->product) {
                        throw new Exception(
                            "Produk ID {$item->product_id} tidak ditemukan"
                        );
                    }

                    if ($item->product->stock < $item->quantity) {
                        throw new Exception(
                            "{$item->product->product_name} stok tidak cukup"
                        );
                    }
                }
                //get table id
                $table_id = Table::findorfail($validated['table_id']);
                $table_id->update([
                    'capacity'=>$validated['capacity'],
                    'status'=>'occupied',
                ]);

                // buat sale
                $sale = Sale::create([
                    'user_id' => auth()->id(),
                    'invoice_number' => 'INV'.time(),
                    'total_amount' => $cart->total_price,
                    'grand_total' => $cart->total_price,
                    'table_id'=>$table_id,
                    'transaction_date'=>now(),
                    'status' => 'ongoing'
                ]);

                // simpan detail
                foreach ($cart->cartItems as $item) {

                    SaleDetail::create([
                        'sale_id' => $sale->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'sub_total'=>$item->subtotal
                    ]);
                }

                // ubah status
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
