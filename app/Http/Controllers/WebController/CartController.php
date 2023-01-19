<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Customer;


class CartController extends Controller
{
    //
    public function index() {
        $customers = Cart::with('customer')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'amount' => 'required',
            'vendor_id' => 'required|numeric',
            'customer_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);
        
        $start_date = date_create($request->start_date);
        $end_date = date_create($request->end_date);
        $existingProductCart = Cart::where('product_id', $request->product_id)->where('customer_id', $request->customer_id)->first();
        if($existingProductCart) {
            $existingProductCart->quantity = $request->quantity;
            $existingProductCart->start_date = date_format($start_date, 'Y-m-d');
            $existingProductCart->end_date = date_format($end_date, 'Y-m-d');
            $existingProductCart->total_date = intval($request->total_dates);
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
                'total_date' => intval($request->total_dates),
            ]);   
        }

        if($save) {
            return back()->with('success', 'Added to Cart Successfully');
        }
    }

    public function destroy(Cart $id) {
        $delete = $id->delete();
        if($delete) return back()->with('success', 'Delete Cart Successfully');
    }


    public function customer_carts() {
        $user_id = session()->get('id');
        $carts = Cart::where('customer_id', $user_id)->with('product')->get();
        return view('frontend.carts.cart', compact('carts'));
    }

    public function update_quantity(Request $request) {
        $cart = Cart::where('id', $request->id)->with('product')->first();
        if(intval($cart->product->stock) >= $request->quantity) {
            $update = $cart->update([
                'quantity' => $request->quantity,
                'amount' => (intval($request->price) * (intval($request->total_date)) * intval($request->quantity))
            ]);   
        } else {
            return response()->json([
                'status' => 406,
                'total' => 0,
                'message' => 'Fail, The quantity is greater than stock.'
            ]);
        }
        
        if($update) {
            return response()->json([
                'status' => 200,
                'total' => (intval($request->price) * (intval($request->total_date)) * intval($request->quantity))
            ]);
        }
    }
}