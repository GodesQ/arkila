<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;

use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class StoreController extends Controller
{
    //
    public function products(Request $request) {
        if($request->has('type')) {
            if($request->type == 'Search') {
                $products = Product::where(DB::raw('lower(product_name)'), 'like', '%' . strtolower($request["query"]) . '%')->latest()->get();
            } else{
                $products = Product::where('category_id', $request["query"])->latest('id')->get();
            }
        } else {
            $products = Product::latest('id')->get();
        }
        
        return response()->json($products);
    }
    
    public function show_product(Request $request) {
        $product = Product::where('id', $request->id)->first();
        $reviews = ProductReview::where('product_id', $product->id)->with('customer')->get();
        return response()->json([
            'product' => $product,
            'reviews' => $reviews
        ]);
    }

    public function categories(Request $request) {
        $categories = Category::all();
        return response()->json($categories);
    }
    
    public function checkout(Request $request) {
        // delete all checkout data that has a cancel status
        Checkout::where('isCancel', 1)->delete();
        $item = Cart::where('id', $request->id)->with('product', 'customer', 'vendor')->first();
        $customer_orders = Checkout::where('product_id', $item->product_id)->with('product', 'customer')->get();
        return response()->json([
            'item' => $item,
            'customer_orders' => $customer_orders
        ]);
    }
    
    public function reviews(Request $request) {
        $reviews = ProductReview::where('product_id', $request->id)->with('customer', 'product')->get();
        $one_rates = ProductReview::where('product_id', $request->id)->where('rate', 1)->get()->count();
        $two_rates = ProductReview::where('product_id', $request->id)->where('rate', 2)->get()->count();
        $three_rates = ProductReview::where('product_id', $request->id)->where('rate', 3)->get()->count();
        $four_rates = ProductReview::where('product_id', $request->id)->where('rate', 4)->get()->count();
        $five_rates = ProductReview::where('product_id', $request->id)->where('rate', 5)->get()->count();
        $average = (5 * $five_rates + 4 * $four_rates + 3 * $three_rates + 2 * $two_rates + 1 * $one_rates) / ($five_rates + $four_rates + $three_rates + $two_rates + $one_rates);
        $total_average = number_format($average, 1);
        return response()->json([
            'reviews' => $reviews,
            'total_average' => $total_average
        ]);
    }
    
    public function review(Request $request) {
        $item = Checkout::where('id', $request->id)->with('customer', 'product')->first();
        return response()->json($item);
    }
    
    public function product_orders(Request $request) {
        $orders = Checkout::where('product_id', $request->product_id)->with('product', 'customer')->get();
        return response()->json($orders);
    }
    
    public function store_review(Request $request) {
        
        $request->validate([
            'review' => 'required',
            'rate' => 'required'
        ]);

        $image_name = null;

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

        Checkout::where('id', $request->checkout_id)->update([
            'status' => 'RATED'
        ]);
        

        if($save) {
            return response()->json([
                'status' => 201,
                'message' => 'Rate Successfully'
            ]);
        }
    }
    
    public function vendor_checkout_notification(Request $request) {
        
        $vendor = Vendor::where('id', $request->vendor_id)->first();
        $vendorLoginAuth = DB::table('customer_api_tokens')->where('user_id', $vendor->id)->first();
        
        $expo = Expo::driver('file');
        
        if($vendorLoginAuth) {
            $message = (new ExpoMessage([
            'title' => $request->title,
            'body' => $request->body,
            ]))
                ->setTitle($request->title)
                ->setBody($request->body)
                ->setData(['id' => $vendor->id, 'isLogin' => true])
                ->setChannelId('default');
            
            $response = $expo->send($message)->to($vendor->device_token)->push();
            $data = $response->getData();
            return response()->json($data);   
        } else {
            $message = (new ExpoMessage([
            'title' => $request->title,
            'body' => $request->body,
            ]))
                ->setTitle($request->title)
                ->setBody($request->body)
                ->setData(['id' => $vendor->id, 'isLogin' => false])
                ->setChannelId('default');
            
            $response = $expo->send($message)->to($vendor->device_token)->push();
            $data = $response->getData();
            return response()->json($data);
        }
    }
    
    public function get_disabled_dates(Request $request) {
        $product_id = $request->get('product_id');
        $checkouts = Checkout::where('product_id', $product_id)->get();
        $disabledDates = [];
        foreach ($checkouts as $key => $checkout) {
            $dates = [
                'start_date' => $checkout->start_date,
                'end_date'=> $checkout->end_date
            ];
            array_push($disabledDates, $dates);
        }
        return response()->json($disabledDates);
    }
}