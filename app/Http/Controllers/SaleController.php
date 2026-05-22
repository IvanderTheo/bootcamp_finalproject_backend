<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleDetails;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;

class SaleController extends Controller
{
    //
    public function checkout(Request $request) {
        $cart = $request->validate(['cart_id'=>'required|exists:cards,id']);
        DB::transaction(function() use($cart){
            $total_price = $cart::select('total_price');
            $items = $cart->cartItem();
            $sale=Sales::create([
                'user_id'=>auth()->id(),
                'invoice_number' => "INV" . random_int(100000, 999999),
                'total_amount'=>$total_price,
                'grand_total'=>$total_price,
                'status'=>'pending',
            ]);

            foreach($cart->items as $item){

                SaleDetails::create([
                    'sale_id'=>$sale->id,
                    'product_id'=>$item->product_id,
                    'quantity'=>$item->quantity,
                    'price'=>$item->price
                ]);

                Products::where(
                    'id',
                    $item->product_id
                )->decrement(
                    'stock',
                    $item->quantity
                );
            }
        });
    }
}
