<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;

class CartController extends Controller
{
    public function customer_carts(Request $request) {
        $carts = Cart::where('customer_id', $request->id)->with('product')->get();
        return response()->json($carts);
    }

    public function destroy(Request $request) {
        $delete = Cart::find($request->id)->delete();
        if($delete) {
            return response()->json([
                'status' => 201,
                'message' => 'Item Successfully Removed'
            ]);
        }
    }

    public function store(Request $request) {
        
        $start_date = date_create($request->start_date);
        $end_date = date_create($request->end_date);
        $existingProductCart = Cart::where('product_id', $request->product_id)->where('customer_id', $request->customer_id)->first();
        if($existingProductCart) {
            $existingProductCart->quantity = $existingProductCart->quantity + $request->quantity;
            $save = $existingProductCart->save();
        } else {
            $save = Cart::create([
                'product_id' => $request->product_id,
                'vendor_id' => $request->vendor_id,
                'customer_id' => $request->customer_id,
                'quantity' => $request->quantity,
                'start_date' => date_format($start_date, 'Y-m-d'),
                'end_date' => date_format($end_date, 'Y-m-d'),
                'amount' => floatval($request->amount) * $request->quantity,
                'total_date' => intval($request->total_date),
            ]);   
        }

        if($save) {
            return response()->json([
                'status' => 200,
                'message' => 'Added To Cart'
            ]);
        }
    }
}