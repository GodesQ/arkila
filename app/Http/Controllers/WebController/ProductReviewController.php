<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkout;
use App\Models\ProductReview;
use App\Models\VendorReview;

class ProductReviewController extends Controller
{
    //
    public function index() {

    }

    public function write_review(Request $request) {
        $item = Checkout::where('id', $request->id)->with('product', 'customer')->first();
        return view('frontend.reviews.write-review', compact('item'));
    }

    public function store_review(Request $request) {
        $request->validate([
            'review' => 'required',
            'rate' => 'required',
            'lender_review' => 'required',
            'lender_rate' => 'required'
        ]);

        $image_name = null;
        $lender_image_name = null;

        if($request->hasFile('review_image')) {
            $file = $request->file('review_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/product_reviews', $image_name);
        }

        $save = ProductReview::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'review' => $request->review,
            'review_image' => $image_name,
            'rate' => $request->rate
        ]);
        
        $save_lender = VendorReview::create([
            'vendor_id' => $request->vendor_id,
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'review' => $request->lender_review,
            'rate' => $request->lender_rate
        ]);

        Checkout::where('id', $request->checkout_id)->update([
            'status' => 'RATED'
        ]);
        

        if($save) {
            return redirect('/store/profile')->with('success', 'Successfully Review');
        }
    }
}