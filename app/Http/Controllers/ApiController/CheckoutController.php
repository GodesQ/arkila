<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomerReview;

use Crazymeeks\Foundation\PaymentGateway\Dragonpay;
use Crazymeeks\Foundation\PaymentGateway\Options\Processor;
use Crazymeeks\Foundation\PaymentGateway\Dragonpay\Token;

class CheckoutController extends Controller {
    
    public function customer_checkouts(Request $request) {
        $customer_id = $request->id;
        if($request->status == 'pending/delivered') {
            $items = Checkout::where('isCancel', 0)
                    ->where('customer_id', $customer_id)
                    ->where('status', '=', 'PENDING')
                    ->orWhere(function($query) use ($customer_id) {
                        $query->where('customer_id', $customer_id)
                              ->where('status', '=', 'DELIVERED');
                    })
                    ->with('product')
                    ->latest('id')
                    ->get();
        } else {
            $items = Checkout::where('isCancel', 0)
                    ->where('customer_id', $customer_id)
                    ->where('status', '=', 'RETURNED')
                    ->orWhere(function($query) use ($customer_id) {
                        $query->where('customer_id', $customer_id)
                              ->where('status', '=', 'RATED');
                    })
                    ->with('product')
                    ->latest('id')
                    ->get();
        }
        return response()->json($items);
    }
    
    public function customer_checkout(Request $request) {
        $checkout_id = $request->get('checkout_id');
        $item = Checkout::where('id', $checkout_id)->with('product', 'customer', 'vendor')->first();
        return response()->json($item);
    }
    
    public function vendor_checkouts(Request $request) {
        $items = Checkout::where('vendor_id', $request->id)->where('isCancel', 0)->with('product', 'customer')->latest('id')->get();
        return response()->json($items);
    }
    
    public function vendor_checkout(Request $request) {
        $checkout = Checkout::where('id', $request->id)->with('product', 'customer')->first();
        return response()->json($checkout);
    }
    
    public function store(Request $request) {
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
            'total_date' => $request->date_length,
            'isCancel' => $request->payment_type == 'COD' ? 0 : 1
        ]);

        $product = Product::where('id', $request->product_id)->first();
        $product->stock = $product->stock - 1;
        $product->save();

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
                    $bytes = random_bytes(10);
                    $data = [
                        'txnid' => $txnid,
                        'refno' => bin2hex($bytes)
                    ];
                    return response()->json([
                        'status' => 201,
                        'type' => $request->payment_type,
                        'url' => null,
                        'vendor_id' => $request->vendor_id,
                        'fullname' => $request->firstname . ' ' . $request->lastname
                    ]);
                case 'BC':
                    return response()->json([
                        'status' => 201,
                        'type' => $request->payment_type,
                        'url' => $dragonpay->setParameters($parameters)->withProcid(Processor::BITCOIN)->away('/')
                    ]);
                    break;
                case 'PAYPAL':
                    // $dragonpay->setParameters($parameters)->withProcid(Processor::PAYPAL)->away();
                    break;
                case 'CC':
                    // $dragonpay->setParameters($parameters)->withProcid(Processor::CREDIT_CARD)->away();
                    break;
                case 'DP_CREDITS':
                    return response()->json([
                        'status' => 201,
                        'url' => $dragonpay->setParameters($parameters)->withProcid(Processor::DRAGONPAY_PREPARED_CREDITS)->away('/')
                    ]);
                    break;
                 case 'GCASH':
                    // $dragonpay->setParameters($parameters)->withProcid(Processor::GCASH)->away();
                    break;  
                case 'BOGUS_BANK':
                    return response()->json([
                        'status' => 201,
                        'url' => $dragonpay->setParameters($parameters)->withProcid('BOGX')->away('/')
                    ]);
                    break;  
                case 'BOG':
                    return response()->json([
                        'status' => 201,
                        'url' => $dragonpay->setParameters($parameters)->withProcid('BOG')->away('/')
                    ]);
                    break;    
            }
        } catch(PaymentException $e){
            echo $e->getMessage();
        } catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function store_vendor_review(Request $request) {
        
        $save = CustomerReview::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'vendor_id' => $request->vendor_id,
            'review' => $request->review,
            'rate' => $request->rate
        ]);

        Checkout::where('id', $request->checkout_id)->update([
            'isVendorRate' => true,
        ]);
        

        if($save) {
            return response()->json([
                'status' => 201,
                'message' => 'Rate Successfully'
            ]);
        }
    }
    
    public function update_status(Request $request) {
        $update = Checkout::where('id', $request->id)->update([
            'status' => $request->status
        ]); 
        
        if($update) {
            return response()->json([
                'status' => 201,
                'message' => 'Update Order Successfully'
            ]);
        }
    }
    
}

?>