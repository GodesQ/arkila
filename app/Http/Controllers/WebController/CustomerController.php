<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function index() {
        return view('backend.customer.customers');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Customer::select('*');
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                           $btn = '<a href="/edit_customer/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="/destroy_customer/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                        return date('F d, Y',strtotime($row->created_at));
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
    }

    public function create() {
        return view('backend.customer.add-customer');
    }

    public function store(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'address' => 'required',
            'customer_image' => 'required|mimes:jpeg,jpg,png',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|unique:customer',
            'confirm_password' => 'required_with:password|same:password'
        ]);

        if($request->hasFile('customer_image')) {
            $file = $request->file('customer_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/customers', $image_name);

            $save = Customer::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
                'address' => $request->address,
                'customer_image' => $image_name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'isVerify' => true,
            ]);

            if($save) {
                return redirect('/customers')->with('success', 'Customer Created Successfully');
            }
        }
    }

    public function show(Request $request) {
        $customer = Customer::where('id', $request->id)->with('customer_reviews', 'confirmed_checkouts')->first();
        $five_rates = $customer->customer_reviews->where('rate', 5)->count();
        $four_rates = $customer->customer_reviews->where('rate', 4)->count();
        $three_rates = $customer->customer_reviews->where('rate', 3)->count();
        $two_rates = $customer->customer_reviews->where('rate', 2)->count();
        $one_rates = $customer->customer_reviews->where('rate', 1)->count();
        $total = $five_rates + $four_rates + $three_rates + $two_rates + $one_rates;
        $average = $total == 0 ? 0 : (5 * $five_rates + 4 * $four_rates + 3 * $three_rates + 2 * $two_rates + 1 * $one_rates) / $total;
        $total_average = number_format($average, 1);
        $review_counts = $customer->customer_reviews->count();
        return view('backend.customer.customer', compact('customer', 'total_average', 'review_counts'));
    }

    public function edit(Request $request) {
        $customer = Customer::where('id', $request->id)->first();
        return view('backend.customer.edit-customer', compact('customer'));
    }

    public function update(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'address' => 'required',
            'customer_image' => 'required|mimes:jpeg,jpg,png',
            'username' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::where('id', $request->id)->first();
        $image_name = $request->old_image;

        if(isset($request->customer_image)) {
            //remove first the old image
            $image = public_path('/assets/images/customers/') . $request->old_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('customer_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/customers', $image_name);
        }

        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->middlename = $request->middlename;
        $customer->address = $request->address;
        $customer->username = $request->username;
        $customer->email = $request->email;
        $customer->customer_image = $image_name;
        $save = $customer->save();

        if($save) {
            return back()->with('success', 'Customer Successfully Updated');
        }

    }

    public function destroy(Customer $id) {
        $image = public_path('/assets/images/customers/') . $id->customer_image;
        $remove_image = @unlink($image);
        $delete = $id->delete();

        if($delete && $remove_image) {
            return back()->with('success', 'Customer Successfully Deleted');
        }
    }
}
