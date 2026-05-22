<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Saldo;
use App\Models\Sales;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    //
    public function payment(Request $request) {
        try {
            $validated = $request->validate([
                'sale_id'=>'required|exists:sales,id',
                'paid_amount'=>'required|decimal',
                'payment_method'=>'required|string',
            ]);
            //validasi uang
            $sale = Sales::findOrFail($validated['sale_id']);
            $grand_total = $sale->grand_total;
            if($validated['paid_amount'] < $grand_total) {
                return response()->json([
                    'status'=>'payment_failed',
                    'message'=>'Saldo Anda tidak cukup'
                ]);
            }

            DB::transaction(function () use($validated,$sale,$grand_total){
                $saldo = Saldo::where('user_id',auth()->id())->firstOrFail();
                // cek saldo user
                if ($saldo->saldo < $grand_total) {
                    throw new Exception('Saldo tidak cukup');
                }
                Payments::create([
                    'sale_id'=>$sale->id,
                    'paid_amount'=>$validated['paid_amount'],
                    'status'=>'pending',
                    'payment_date'=>now(),
                    'payment_method'=>$validated['payment_method'],
                ]);
                $saldo->decrement('saldo',$grand_total);
                $sale->update(['status' => 'paid']);
            });
            return response()->json([
                'status'=>'success',
                'message'=>'payment success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'=>'payment failed',
                'message'=>$e->getMessage(),
            ]);
        }
    }
}
