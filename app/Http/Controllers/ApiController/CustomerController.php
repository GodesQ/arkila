<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function profile(Request $request) {
        $user = Customer::where('id', $request->id)->with('carts', 'checkout')->first();
        return response()->json($user);
    }
    
    public function update_profile(Request $request) {
        $customer = Customer::where('id', $request->id)->first();
        $image_name = $request->customer_image;
        
        if(isset($request->new_image)) {
            //remove first the old image
            $image = public_path('/assets/images/customers/') . $request->old_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('new_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/customers', $image_name);
        }

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->middlename = $request->middlename;
        $customer->address = $request->address;
        $customer->username = $request->username;
        $customer->customer_image = $image_name;
        $save = $customer->save();

        if($save) {
            return response()->json([
                'status' => 201,
                'message' => 'Profile Update Successfully'
            ]);
        }
    }
}