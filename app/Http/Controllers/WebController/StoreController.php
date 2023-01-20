<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Customer;
use App\Models\CustomerReview;
use App\Models\VendorReview;
use App\Models\Transaction;
use App\Models\Vendor;
use App\Models\ProductReview;

use Yajra\DataTables\Facades\DataTables;

use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\Options\Processor;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Token;

class StoreController extends Controller
{
    //
    public function index() {
        // if($request->ajax()) {}
        $products = Product::latest('id')->paginate(12);
        $categories = Category::all();
        return view('frontend.index', compact('categories', 'products'));
    }

    public function fetch_products(Request $request) {
        abort_if(!$request->ajax(), 404);

        $categories = json_decode($request->categories) ? json_decode($request->categories) : [];
        $keyword = $request->keyword;
        $price = $request->price;

        $products = Product::select('*')
        ->when($categories, function ($q) use ($categories) {
            if(count($categories)) return $q->whereIn('category_id', $categories);
        })
        ->when($price, function ($q) use ($price) {
            $range = explode(';', $price);
            return $q->whereBetween('amount', [$range[0], $range[1]]);
        })
        ->when($keyword, function ($q) use ($keyword) {
            return $q->where(DB::raw('lower(product_name)'), 'like', '%' . strtolower($keyword) . '%')
                    ->orWhere(DB::raw('lower(description)'), 'like', '%' . strtolower($keyword) . '%');
        })
        ->latest('id')
        ->paginate(12);

        $view_data = view('frontend.products.fetch_products', compact('products'))->render();

        return response()->json([
            'view_data' => $view_data,
        ]);
    }

    public function categories(Request $request) {
        $category = Category::where('id', $request->id)->first();
        $products = Product::where('category_id', $request->id)->latest('created_at')->get();
        return view('frontend.categories.categories', compact('category', 'products'));
    }

    public function product(Request $request) {
        $product = Product::where('id', $request->id)->with('reviews', 'vendor')->firstOrFail();
        $cart = Cart::where('product_id', $product->id)->where('customer_id', session()->get('id'))->first();
        return view('frontend.products.product', compact('product', 'cart'));
    }

    public function checkout(Request $request) {
        // delete all checkout data that has a cancel status
        Checkout::where('isCancel', 1)->delete();
        $item = Cart::where('id', $request->id)->with('product', 'customer')->firstOrFail();
        return view('frontend.checkout.checkout', compact('item'));
    }

    public function checkout_detail(Request $request) {
        $checkout = Checkout::where('id', $request->id)->with('product', 'customer', 'vendor')->firstOrFail();
        return view('frontend.checkout.checkout-detail', compact('checkout'));
    }

    public function get_disabled_dates(Request $request) {
        $checkouts = Checkout::where('product_id', $request->product_id)->get();
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

    public function return_checkout(Request $request) {
        $data = $request->all();
        if($request->status == 'F') {
            $delete = Checkout::where('id', $request->param1)->delete();
            return view('frontend.checkout.fail_checkout', compact('data'));
        }
        $update_checkout = Checkout::where('id', $request->param1)->update([
            'isCancel' => 0
        ]);

        if($update_checkout) {
            Checkout::where('isCancel', 1)->delete();
            Transaction::create($request->all());
            return view('frontend.checkout.success_checkout', compact('data'));
        }
    }

    public function store_checkout(Request $request) {
        $merchant_account = [
            'merchantid' => env('DRAGONPAY_ID'),
            'password'   => env('DRAGONPAY_PASSWORD')
        ];
        $dragonpay = new Dragonpay($merchant_account);
        $dragonpay->handlePostback(function($data){
            DB::table('mytable')->insert($data);
        }, $request->all());
    }


    public function profile() {
        $user_id = session()->get('id');
        $user = Customer::where('id', $user_id)->firstOrFail();
        $pending_count = Checkout::where('customer_id', $user_id)->where('status', 'PENDING')->get()->count();
        $delivered_count = Checkout::where('customer_id', $user_id)->where('status', 'DELIVERED')->get()->count();
        $returned_count = Checkout::where('customer_id', $user_id)->where('status', 'RETURNED')->get()->count();
        $rated_count = Checkout::where('customer_id', $user_id)->where('status', 'RATED')->get()->count();

        $reviews = CustomerReview::where('customer_id', $user_id)->with('customer', 'vendor')->get();
        $one_rates = CustomerReview::where('customer_id', $user_id)->where('rate', 1)->get()->count();
        $two_rates = CustomerReview::where('customer_id', $user_id)->where('rate', 2)->get()->count();
        $three_rates = CustomerReview::where('customer_id', $user_id)->where('rate', 3)->get()->count();
        $four_rates = CustomerReview::where('customer_id', $user_id)->where('rate', 4)->get()->count();
        $five_rates = CustomerReview::where('customer_id', $user_id)->where('rate', 5)->get()->count();

        $sub_average = $five_rates + $four_rates + $three_rates + $two_rates + $one_rates;
        $average = $sub_average == 0 ? 0 : (5 * $five_rates + 4 * $four_rates + 3 * $three_rates + 2 * $two_rates + 1 * $one_rates) / $sub_average;
        $total_average = number_format($average, 1);

        return view('frontend.profile.profile', compact('user', 'pending_count', 'delivered_count', 'returned_count', 'rated_count', 'reviews', 'total_average'));
    }

    public function update_profile(Request $request) {

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'username' => 'required'
        ]);

        $image_name = $request->old_image;

        if($request->hasFile('customer_image')) {
            $file = $request->file('customer_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/customers', $image_name);
        }

        $save = Customer::where('id', $request->id)->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'address' => $request->address,
            'email' => $request->email,
            'contact_no' => $request->contactno,
            'customer_image' => $image_name,
            'username' => $request->username
        ]);

        return back()->with('success', 'Update Successfully');
    }

    public function profile_order_table(Request $request) {
        $data = Checkout::select('*')->where('customer_id', session()->get('id'))->where('isCancel', '=', 0)->latest('id')->with('product');
        return Datatables::of($data)
                    ->addColumn('product_image', function($row) {
                        return '<img height="60" width="60" src="../../../assets/images/products/'. $row->product->product_image .'" >';
                    })
                    ->addColumn('product_name', function($row) {
                        return substr($row->product->product_name, 0, 10) . "...";
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="/store/checkout_detail/' . $row->id . '" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
                            return $btn;
                    })
                    ->addColumn('review', function($row){
                        if($row->status == "PENDING") {
                            $btn = '<a href="/store/update_checkout_status?id='.$row->id.'&status=DELIVERED" class="edit btn btn-primary btn-sm" style="font-size: 12px; padding: 5px;">ORDER RECEIVED</a>';
                        } else if($row->status == "DELIVERED") {
                            $btn = '<a href="/store/update_checkout_status?id='.$row->id.'&status=RETURNED" class="edit btn btn-success btn-sm" style="font-size: 12px; padding: 10px;">ORDER RETURNED</a>';
                        } else if($row->status == 'RETURNED') {
                            $btn = '<a href="/store/write_review/'.$row->id.'" class="edit btn btn-secondary btn-sm" style="font-size: 12px; padding: 10px;">RATE ORDER</a>';
                        } else {
                            $btn = 'Product has already been rated.';
                        }
                         return $btn;
                    })
                    ->rawColumns(['product_image', 'action', 'review'])
                    ->toJson();
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
        return view('frontend.reviews.reviews', compact('reviews', 'total_average'));
    }

    public function store_review(Request $request) {
        $request->validate([
            'review' => 'required',
            'rate' => 'required'
        ]);


        $image_name = null;
        $lender_image_name = null;

        if($request->hasFile('review_image')) {
            $file = $request->file('review_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/product_reviews', $image_name);
        }

        if($request->hasFile('review_lender_image')) {
            $file = $request->file('review_lender_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/vendor_reviews', $image_name);
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
            'review_image' => $lender_image_name,
            'rate' => $request->lender_rate
        ]);

        Checkout::where('id', $request->checkout_id)->update([
            'status' => 'RATED'
        ]);


        if($save) {
            return redirect('/store/profile')->with('success', 'Successfully Review');
        }
    }

    public function vendor(Request $request) {
        $vendor = Vendor::where('id', $request->id)->with('products')->first();

        $reviews = VendorReview::where('vendor_id', $vendor->id)->with('customer', 'vendor')->get();
        $one_rates = VendorReview::where('vendor_id', $vendor->id)->where('rate', 1)->get()->count();
        $two_rates = VendorReview::where('vendor_id', $vendor->id)->where('rate', 2)->get()->count();
        $three_rates = VendorReview::where('vendor_id', $vendor->id)->where('rate', 3)->get()->count();
        $four_rates = VendorReview::where('vendor_id', $vendor->id)->where('rate', 4)->get()->count();
        $five_rates = VendorReview::where('vendor_id', $vendor->id)->where('rate', 5)->get()->count();

        $sub_average = $five_rates + $four_rates + $three_rates + $two_rates + $one_rates;
        $average = $sub_average == 0 ? 0 : (5 * $five_rates + 4 * $four_rates + 3 * $three_rates + 2 * $two_rates + 1 * $one_rates) / $sub_average;
        $total_average = number_format($average, 1);

        return view('frontend.vendor.vendor_profile', compact('vendor', 'total_average', 'reviews'));
    }

    public function search(Request $request) {
        $query = $_GET['query'];
        $column = 'product_name';
        if(!$query) {
            return redirect('/')->with('fail', 'Search Input Required');
        }
        $products = Product::where(DB::raw('lower(product_name)'), 'like', '%' . strtolower($query) . '%')->get();
        return view('frontend.search.search', compact("products",  "query"));
    }

    public function update_checkout_status(Request $request) {
        $checkout = Checkout::where('id', $request->id)->first();

        $update =  $checkout->update([
            'status' => $request->status
        ]);

        $redirect_url = '/store/checkout_detail/' . $checkout->id;

        if($update) return redirect($redirect_url)->with('success', 'Update Status Successfully');
    }

    public function verify_message(Request $request) {
        return view('frontend.misc.verify_message');
    }
 }
