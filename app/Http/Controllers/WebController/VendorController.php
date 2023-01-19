<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;


class VendorController extends Controller
{
    public function dashboard() {
        $orders_count = Checkout::where('isCancel', 0)->where('vendor_id', session()->get('id'))->count();
        $earnings_total = Checkout::where('isCancel', 0)->where('vendor_id', session()->get('id'))->sum('total');
        $carts_count = Cart::where('vendor_id', session()->get('id'))->count();
        $products_count = Product::where('vendor_id', session()->get('id'))->count();
        $orders = Checkout::where('isCancel', 0)->where('vendor_id', session()->get('id'))->latest('created_at')->limit(10)->get();
        return view('backend.dashboard.dashboard', compact('orders', 'orders_count', 'earnings_total', 'carts_count', 'products_count'));
    }

    public function index() {
        return view('backend.vendor.vendors');
    }

    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Vendor::select('*');
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                           $btn = '<a href="/edit_vendor/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="/destroy_vendor/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
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
        return view('backend.vendor.add_vendor');
    }

    public function store(Request $request) {
        
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'address' => 'required',
            'vendor_image' => 'required|mimes:jpeg,jpg,png',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|unique:vendor',
            'confirm_password' => 'required_with:password|same:password'  
        ]);

        if($request->hasFile('vendor_image')) {
            $file = $request->file('vendor_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/vendors', $image_name);

            $save = Vendor::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
                'address' => $request->address,
                'vendor_image' => $image_name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
                'vendor_description' => $request->vendor_description,
                'contactno' => $request->contactno,
                'isVerify' => true,
            ]);

            if($save) {
                return redirect('/vendors')->with('success', 'Vendor Created Successfully');
            }
        }
    }

    public function edit(Vendor $id) {
        return view('backend.vendor.edit_vendor', ['vendor' => $id]);
    }

    public function update(Request $request) {
        $vendor = Vendor::where('id', $request->id)->first();
        $image_name = $request->old_image;
        
        if(isset($request->vendor_image)) {
            //remove first the old image
            $image = public_path('/assets/images/vendors/') . $request->old_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('vendor_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/vendors', $image_name);
            
            session()->put('profile_picture', $image_name);
            
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
        
        

        return back()->with('success', 'Update Successfully.');
    }

    public function destroy(Vendor $id) {
        $image = public_path('/assets/images/vendors/') . $id->vendor_image;
        $remove_image = @unlink($image);
        $delete = $id->delete();

        if($delete && $remove_image) {
            return back()->with('success', 'Vendor Successfully Deleted');
        }
    }
    
    public function profile(Request $request) {
        $id = session()->get('id');
        $vendor = Vendor::where('id', $id)->first();
        return view('backend.vendor.profile', compact('vendor'));
    }

    public function search(Request $request) {

        $data = [
            [
                'id' => 1,
                'name' => 'James Garnfil'
            ],
            [
                'id' => 2,
                'name' => 'Benedict Fernandez'
            ],
            [
                'id' => 3,
                'name' => 'Kerby George'
            ],
        ];
        
        return response()->json($data);
    }
}