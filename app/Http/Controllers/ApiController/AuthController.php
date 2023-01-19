<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Customer;
use App\Models\Vendor;
use App\Http\Middleware\CustomerApiAuthenticate;
use App\Http\Middleware\VendorApiAuthenticate;

use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Mail\CustomerVerificationMail;



class AuthController extends Controller
{   
    
    public function login(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {    
            return response()->json(['errors' => $validator->messages(), 'status' => 422]);
        }
        
        $customerExist = Customer::where('email', $request->email)->first();
         
         if(!$customerExist) {
            return response()->json([
                'status' => 406,
                'message' => "Sorry, your email doesn't exist."
            ]);
         }
 
         if(!Hash::check($request->password, $customerExist->password)) {
            return response()->json([
                'status' => 406,
                'message' => "Sorry, your password is incorrect"
            ]);
         }
         
         if(!$customerExist->isVerify){
             return response()->json([
                'status' => 406,
                'message' => "Please verify your email to continue."
            ]);
         };
 
         /* == GENERATE TOKEN == */
        $token = (new CustomerApiAuthenticate)->generateToken($customerExist->id);
         
         return response()->json([
            'status' => 201,
            'data' =>  [ 
                'id' => $customerExist->id,
                'token' => $token
            ]
         ]);
        
    }
    
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required|unique:customer',
            'password' => 'required',
            'email' => 'required|unique:customer',
            'confirm_password' => 'required_with:password|same:password'  
        ]);
        
        if ($validator->fails()) {    
            return response()->json(['errors' => $validator->messages(), 'status' => 422]);
        }
        
        $save = Customer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $details = [
            'title' => 'Verification email from Arkila',
            'email' => $request->email,
            'firstname' => $request->firstname,
        ];
        
        // SEND EMAIL FOR VERIFICATION
        $submit_email = Mail::to($request->email)->send(new CustomerVerificationMail($details));

        if($save) {
            return response()->json([
                'message' => 'Register Successfully',
                'status' => 201,
            ]);
        }
    }
    
    public function vendor_register(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|unique:vendor',
            'confirm_password' => 'required_with:password|same:password'  
        ]);
        
        $save = Vendor::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $details = [
            'title' => 'Verification email from Arkila',
            'email' => $request->email,
        ];
        
        // SEND EMAIL FOR VERIFICATION
        Mail::to($request->email)->send(new VerificationMail($details));

        if($save) {
            return response()->json([
                'status' => 201,
                'message' => 'Register Successfully'
            ]);
        }
    }

    public function vendor_login(Request $request) {
        $vendorExist = Vendor::where('email', $request->email)->first();
         if(!$vendorExist) {
            return response()->json([
                'status' => 406,
                'message' => "Sorry, your email doesn't exist."
            ]);
         }
         
         if(!$vendorExist->isVerify){
             return response()->json([
                'status' => 406,
                'message' => "Please verify your email to continue."
            ]);
         };
 
         if(!Hash::check($request->password, $vendorExist->password)) {
            return response()->json([
                'status' => 406,
                'message' => "Sorry, your password is incorrect"
            ]);
         }
         
        $vendorExist->device_token = $request->deviceToken;
        $vendorExist->save();
 
         /* == GENERATE TOKEN == */
        $token = (new VendorApiAuthenticate)->generateVendorToken($vendorExist->id);
         
         return response()->json([
            'status' => 201,
            'data' =>  [ 
                'expoToken' => $request->deviceToken,
                'id' => $vendorExist->id,
                'token' => $token
            ]
         ]);
    }

    public function logout(Request $request)
    {  
        $remove = (new CustomerApiAuthenticate)->removeToken($request->header('token'));
        
        if($remove) {
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Logout'
            ]);
        } 

        return response()->json([
            'status' => 406,
            'message' => "user token didn't exist"
        ]);
    }

    public function vendor_logout(Request $request)
    {  
        $remove = (new VendorApiAuthenticate)->removeVendorToken($request->header('token'));
        
        if($remove) {
            return response()->json([
                'status' => 200,
                'message' => 'Successfully Logout'
            ]);
        } 

        return response()->json([
            'status' => 406,
            'message' => "user token didn't exist"
        ]);
    }
}