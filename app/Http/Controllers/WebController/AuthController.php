<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Mail\CustomerVerificationMail;

use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\SessionToken;


class AuthController extends Controller
{
    /*
    - Route for Login Vendor
    - 'vendor/login'
    */
    public function vendor_login() {
       return view('backend.auth.login');
    }

    /*
    - Route for Save Login Vendor
    - 'vendor/save_vendor_login'
    */
    public function save_vendor_login(Request $request) {
        
       $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        // $allowedEmailDomain = 'ciit.edu.ph';
        // $request_domain_value = explode('@', $request->email)[1];
        // if($allowedEmailDomain != $request_domain_value) return back()->with('fail', 'The domain of your email is invalid');
        
        $vendorExist = Vendor::where('email', $request->email)->first();
        
        if(!$vendorExist) return back()->with('fail', "Sorry your email doesn't exist");

        if(!Hash::check($request->password, $vendorExist->password)) return back()->with('fail', "Sorry your password is incorrect.");

        if(!$vendorExist->isVerify) return back()->with('fail', "Please verify your email address to continue.");

        /* == GENERATE TOKEN == */
        $token = openssl_random_pseudo_bytes(16);
        $final_token = bin2hex($token);
        
        // Store session if the user passed all the validation
        $request->session()->put([
            'token' => $final_token,
            'role' => 'vendor',
            'id' => $vendorExist->id,
            'profile_picture' => $vendorExist->vendor_image,
            'created_date' => $vendorExist->created_date,
            'firstname' => $vendorExist->firstname,
            'lastname' => $vendorExist->lastname,
        ]);
        
        return redirect('/vendor/dashboard');
    }

    /*
    - Route for Register Vendor
    - 'vendor/register'
    */
    public function vendor_register() {
        return view('backend.auth.register');
    }

    /*
    - Route for Save Register Vendor
    - 'vendor/save_register'
    */
    public function save_vendor_register(Request $request) {
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|unique:vendor',
            'confirm_password' => 'required_with:password|same:password'  
        ]);
        
        // $allowedEmailDomain = 'ciit.edu.ph';
        // $request_domain_value = explode('@', $request->email)[1];
        // if($allowedEmailDomain != $request_domain_value) return back()->with('fail', 'The domain of your email is not valid');
        
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
            return redirect('verify_message')->with('success', 'Register Successfully');
        }
    }

    /*
    - Route for Verify Vendor
    - 'vendor/verify_email'
    */
    public function verify_email(Request $request)
    {
        $patient = Vendor::where('email', '=', $request->verify_email)->first();
        $patient->isVerify = true;
        $save = $patient->save();
        if ($save) {
            return redirect('vendor/login')->with(
                'success',
                'Your Email Address was successfully verified.'
            );
        }
    }

    


    /*
    - Route for Login Admin
    - '/vendor/login'
    */
    public function admin_login() {
        return view('backend.auth.admin_login');
    }

    /*
    - Route for Save Login Vendor
    - 'vendor/save_vendor_login'
    */
    public function save_admin_login(Request $request) {
        
        $request->validate([
             'username' => 'required',
             'password' => 'required',
         ]);
         
         $adminExist = Admin::where('username', $request->username)->first();
         
         if(!$adminExist) return back()->with('fail', "Sorry your username doesn't exist");
 
         if(!Hash::check($request->password, $adminExist->password)) return back()->with('fail', "Sorry your password is incorrect.");

        /* == GENERATE TOKEN == */
        $token = openssl_random_pseudo_bytes(16);
        $final_token = bin2hex($token);
 
         // Store session if the user passed all the validation
         $request->session()->put([
             'token' => $final_token,
             'role' => 'admin',
             'username' => $adminExist->username,
             'id' => $adminExist->id,
             'created_date' => $adminExist->created_date,
         ]);
         
         return redirect('/admin/dashboard');
      }



    /*
    - Route for Logout Vendor
    - '/vendor/logout'
    */
    public function vendor_logout() {
        $token = session()->get('token');

        if (session()->has(['token'])) {
            session()->flush();
            return redirect('/vendor/login')->with('success', "Logout Successfully.");
        }
    }

    /*
    - Route for Logout Customer
    - '/admin/logout'
    */
    public function customer_logout() {
        $token = session()->get('token');

        if (session()->has(['token']) && session()->has(['role'])) {
            session()->flush();
            return redirect('/')->with('success', "Logout Successfully.");
        }
    }

    /*
    - Route for Logout Admiin
    - '/admin/logout'
    */
    public function admin_logout() {
        $token = session()->get('token');

        if (session()->has(['token'])) {
            session()->flush();
            return redirect('/admin/login')->with('success', "Logout Successfully.");
        }
    }

    /*
    - Route for Login Customer
    - '/login'
    */
    public function customer_login() {
        return view('frontend.auth.login');
    }

    public function save_customer_login(Request $request) {
        
        $request->validate([
             'email' => 'required',
             'password' => 'required',
         ]);
         
         $customerExist = Customer::where('email', $request->email)->first();
         
        // $allowedEmailDomain = 'ciit.edu.ph';
        // $request_domain_value = explode('@', $request->email)[1];
        // if($allowedEmailDomain != $request_domain_value) return back()->with('fail', 'The domain of your email is not valid');
         
         if(!$customerExist) return back()->with('fail', "Sorry your email doesn't exist");
 
         if(!Hash::check($request->password, $customerExist->password)) return back()->with('fail', "Sorry your password is incorrect.");
 
         if(!$customerExist->isVerify) return back()->with('fail', "Please verify your email address to continue.");
         

         /* == GENERATE TOKEN == */
         $token = openssl_random_pseudo_bytes(16);
         $final_token = bin2hex($token);

         // Store session if the user passed all the validation
         $request->session()->put([
            'token' => $final_token,
            'role' => 'customer',
            'id' => $customerExist->id,
            'created_date' => $customerExist->created_date,
            'firstname' => $customerExist->firstname,
            'lastname' => $customerExist->lastname,
         ]);
         
         return redirect('/store/profile')->with('success', 'Login Successfully');
     }


     /*
    - Route for Register Customer
    - '/register'
    */
    public function customer_register() {
        return view('frontend.auth.register');
    }

    public function save_customer_register(Request $request) {
        
        $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required',
            'password' => 'required',
            'username' => 'required|unique:customer|max:20',
            'email' => 'required|unique:customer',
            'confirm_password' => 'required_with:password|same:password'  
        ]);
        
        // $allowedEmailDomain = 'ciit.edu.ph';
        // $request_domain_value = explode('@', $request->email)[1];
        // if($allowedEmailDomain != $request_domain_value) return back()->with('fail', 'The domain of your email is not valid');
        
        $save = Customer::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'isVerify' => false,
        ]);

        $details = [
            'title' => 'Verification email from Arkila',
            'email' => $request->email,
            'firstname' => $request->firstname,
        ];
        
        // SEND EMAIL FOR VERIFICATION
        Mail::to($request->email)->send(new CustomerVerificationMail($details));

        if($save) {
            return redirect('/verify_message')->with('success', 'Register Successfully');
        }
    }

    /*
    - Route for Verify Vendor
    - 'vendor/verify_email'
    */
    public function customer_verify_email(Request $request)
    {
        $customer = Customer::where('email', '=', $request->verify_email)->first();
        $customer->isVerify = true;
        $save = $customer->save();
        if ($save) {
            return redirect('/login')->with(
                'success',
                'Your Email Address was successfully verified.'
            );
        }
    }
    
    public function change_password(Request $request) {
        $request->validate([
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        
        $customer = Customer::where('id', '=', $request->id)->first();
        
        if(!Hash::check($request->old_password, $customer->password)) return back()->with('fail', "Sorry your password is incorrect.");
        
        $customer->password = Hash::make($request->password);
        $save = $customer->save();
        
        if($save) {
            return back()->with('success', 'New Password Created');   
        }
    }
    
}