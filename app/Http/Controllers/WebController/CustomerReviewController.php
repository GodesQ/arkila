<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomerReview;
use App\Models\Checkout;

class CustomerReviewController extends Controller
{
    //
    public function store_checkout_customer_review(Request $request) {

        $request->validate([
            'review' => 'required',
            'item_status' => 'required',
            'rate' => 'required'
        ]);

        $save = CustomerReview::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'vendor_id' => $request->vendor_id,
            'review' => $request->review,
            'rate' => $request->rate,
            'item_status' => $request->item_status,
        ]);

        Checkout::where('id', $request->checkout_id)->update([
            'isVendorRate' => true
        ]);

        if($save) return redirect('/checkouts')->with('success', 'Successfully Review');
    }
}
