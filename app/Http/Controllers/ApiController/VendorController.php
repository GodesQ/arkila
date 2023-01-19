<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Checkout;

class VendorController extends Controller
{
    //
    public function index() {
        return response()->json(Vendor::all()); 
    }
    
    public function dashboard(Request $request ) {
        $orders = Checkout::where('isCancel', 0)->where('vendor_id', $request->id)->count();
        $earnings = Checkout::where('isCancel', 0)->where('vendor_id', $request->id)->sum('total');
        $carts = Cart::where('vendor_id', $request->id)->count();
        $products = Product::where('vendor_id', $request->id)->count();
        return response()->json([
            'products_count' =>$products,
            'carts_count' => $carts,
            'orders_count' => $orders,
            'earnings' => $earnings,
            'status' => 200
        ]);
    }
    
    public function vendor_profile(Request $request) {
        $vendor = Vendor::where('id', $request->id)->first();
        return response()->json($vendor);
    }
    
    public function shop_profile(Request $request) {
        $vendor = Vendor::where('id', $request->id)->with('products')->first();
        return response()->json($vendor);
    }
    
    public function update_vendor(Request $request) {
        
        $vendor = Vendor::where('id', $request->id)->first();
        $image_name = $request->vendor_image;
        
        if(isset($request->new_image) || $request->new_image) {
            //remove first the old image
            $image = public_path('/assets/images/vendors/') . $request->vendor_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('new_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/vendors', $image_name);
        }
        
        $vendor->firstname = $request->firstname;
        $vendor->lastname = $request->lastname;
        $vendor->middlename = $request->middlename;
        $vendor->address = $request->address;
        $vendor->username = $request->username;
        $vendor->email = $request->email;
        $vendor->vendor_image = $image_name;
        $vendor->contactno = $request->contactno;
        $vendor->vendor_description = $request->vendor_description;
        $save = $vendor->save();

        return response()->json([
            'status' => 201,
            'message' => 'Profile Update Successully'
        ]);
    }
}