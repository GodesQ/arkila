<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Checkout;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Vendor;

use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\Options\Processor;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Token;

use Illuminate\Support\Facades\DB;

use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class CheckoutController extends Controller
{
    //
    public function index() {
        return view('backend.checkouts.checkouts');
    }

    public function table(Request $request) {
        if(session()->get('role') == 'vendor') {
            $data = Checkout::select('*')->where('vendor_id', session()->get('id'))->where('isCancel', '=', 0)->with('product', 'customer')->latest();
        } else {
            $data = Checkout::select('*')->where('isCancel', 0)->with('product', 'customer', 'vendor');
        }

        return Datatables::of($data)
                    ->addColumn('product_image', function($row) {
                        return '<img height="60" width="60" src="../../../assets/images/products/'. $row->product->product_image .'" >';
                    })
                    ->addColumn('product_name', function($row) {
                        return substr($row->product->product_name, 0, 10) . "...";
                    })
                    ->addColumn('customer', function($row){
                        return $row->customer->firstname . " " . $row->customer->lastname;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="/checkout/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>';
                         return $btn;
                    })
                    ->addColumn('review_btn', function($row){
                        $btn = null;
                        if(!$row->isVendorRate && session()->get('role') == 'vendor') {
                           return $btn = '<a href="/checkout_customer_review/'.$row->id.'" class="edit btn btn-secondary btn-sm">Add Customer Review</a>';
                        }
                         return $btn;
                    })
                    ->rawColumns(['product_image', 'action', 'review_btn'])
                    ->toJson();
        
    }

    public function store_checkout(Request $request)
    {   
        $request->validate([
            'customer_id' => 'required',
            'vendor_id' => 'required',
            'product_id' => 'required',
            'cart_id' => 'required',
            'total' => 'required', 
            'quantity' => 'required',
            'payment_type' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'email' => 'required',
            'contactno' =>'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'total_dates' => 'required',
        ]);
        
        $txnid = rand(100000, 100000000);
        $save = Checkout::create([
            'customer_id' => $request->customer_id,
            'vendor_id' => $request->vendor_id,
            'product_id' => $request->product_id,
            'cart_id' => $request->cart_id,
            'txnid' => $txnid,
            'total' => floatval($request->total), 
            'quantity' => $request->quantity,
            'payment_type' => $request->payment_type,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'email' => $request->email,
            'contactno' => $request->contactno,
            'status' => 'PENDING',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_date' => $request->total_dates,
            'isCancel' => $request->payment_type == 'COD' ? 0 : 1
        ]);

        // $product = Product::where('id', $request->product_id)->first();
        // $product->stock = $product->stock - 1;
        // $product->save();

        $parameters = [
            'txnid' => $txnid,
            'amount' => floatval($request->total), 
            'ccy' => 'PHP', 
            'description' => 'Product ' . $request->product_name, 
            'email' => $request->email, 
            'param1' => $save->id, 
            'BillingDetails' => [
                "FirstName" => $request->firstname,
                "LastName" => $request->lastname,
                "Address1" => $request->address,
                "ZipCode" => $request->zip_code,
                "TelNo" => $request->contactno,
                "Email" => $request->email,
            ]
        ];

        // Setup DragonPay Account
        $merchant_account = [
            'merchantid' => env('DRAGONPAY_ID'),
            'password'   => env('DRAGONPAY_PASSWORD')
        ];

        // Initialize Dragonpay
        $dragonpay = new Dragonpay($merchant_account);

        try {
            switch ($request->payment_type) {
                case 'COD':
                    $vendor = Vendor::where('id', $request->vendor_id)->first();
                    $vendorLoginAuth = DB::table('vendor_api_tokens')->where('user_id', $vendor->id)->first();
                    $fullname = $request->firstname . ' ' . $request->lastname;
                    $expo = Expo::driver('file');
                    $bytes = random_bytes(10);
                    if($vendorLoginAuth) {
                        $message = (new ExpoMessage([
                        'title' => 'New Order',
                        'body' => 'Your Product has new order',
                        ]))
                            ->setTitle('New Order')
                            ->setBody($fullname . ' purchase ' . $request->product_name)
                            ->setData(['id' => $vendor->id, 'isLogin' => true])
                            ->setChannelId('default');
                        $response = $expo->send($message)->to($vendor->device_token)->push();
                    } else {
                        $message = (new ExpoMessage([
                        'title' => $request->title,
                        'body' => $request->body,
                        ]))
                            ->setTitle('New Order')
                            ->setBody($fullname . ' purchase ' . $request->product_name . ". " . 'Login Now.')
                            ->setData(['id' => $vendor->id, 'isLogin' => false])
                            ->setChannelId('default');
                        if($vendor->device_token) $expo->send($message)->to($vendor->device_token)->push();
                    }
                    
                    $data = [
                        'txnid' => $txnid,
                        'refno' => bin2hex($bytes)
                    ];
                    
                    return view('frontend.checkout.success_checkout', compact('data'));
                    
                case 'BC':
                    $dragonpay->setParameters($parameters)->withProcid(Processor::BITCOIN)->away();
                    break;
                case 'PAYPAL':
                    $dragonpay->setParameters($parameters)->withProcid(Processor::PAYPAL)->away();
                    break;
                case 'CC':
                    $dragonpay->setParameters($parameters)->withProcid(Processor::CREDIT_CARD)->away();
                    break;
                case 'DP_CREDITS':
                    $dragonpay->setParameters($parameters)->withProcid(Processor::DRAGONPAY_PREPARED_CREDITS)->away();
                    break;
                 case 'GCASH':
                    $dragonpay->setParameters($parameters)->withProcid(Processor::GCASH)->away();
                    break;  
                case 'BOGUS_BANK':
                    $dragonpay->setParameters($parameters)->withProcid('BOGX')->away();
                    break;  
                case 'BOG':
                    $dragonpay->setParameters($parameters)->withProcid('BOG')->away();
                    break;    
            }
        } catch(PaymentException $e){
            echo $e->getMessage();
        } catch(\Exception $e){
            echo $e->getMessage();
        }

    }

    public function show(Request $request) {
        $checkout = Checkout::where('id', $request->id)->with('product', 'customer', 'vendor')->first();
        return view('backend.checkouts.checkout', compact('checkout'));
    }

    public function add_checkout_customer_review(Request $request) {
        $item = Checkout::where('id', $request->id)->with('product', 'customer')->first();
        return view('backend.checkouts.checkout_customer_review', compact('item'));
    }
}