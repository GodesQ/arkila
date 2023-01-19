<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Admin;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
        $orders_count = Checkout::where('isCancel', 0)->count();
        $earnings_total = Checkout::where('isCancel', 0)->sum('total');
        $carts_count = Cart::count();
        $products_count = Product::count();
        $orders = Checkout::where('isCancel', 0)->latest('created_at')->limit(10)->get();
        
        return view('backend.dashboard.admin_dashboard', compact('orders', 'orders_count', 'earnings_total', 'carts_count', 'products_count'));
    }
    
    public function index() {
        return view('backend.admin.admins');
    }
    
    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Admin::select('*');
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                           $btn = '<a href="/edit_admin/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <button id="'.$row->id.'" class="delete-admin btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
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
        return view('backend.admin.add_admin');
    }
    
    public function store(Request $request) {
         $request->validate([
            'username' => 'required|unique:admin',
            'password' => 'required',
            'email' => 'required|unique:admin',
            'confirm_password' => 'required_with:password|same:password'  
        ]);
        
        $save = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        if($save) {
            return redirect('/admins')->with('success', 'Create Admin Successfully');
        }
    }
    
    public function edit(Request $request) {
        $admin = Admin::where('id', $request->id)->firstOrFail();
        return view('backend.admin.edit_admin', compact('admin'));
    }
    
    public function update(Request $request) {
        $admin = Admin::where('id', $request->id)->firstOrFail();
        $save = $admin->update([
            'username' => $request->username,
            'email' => $request->email
        ]);
        
        if($save) return back()->with('success', 'Update Successfully');
    }
    
    public function destroy(Request $request) {
        $admin_delete = Admin::where('id', $request->id)->delete();
        if($admin_delete ) {
            return response()->json([
                'status' => '201',
                'message' => 'Deleted Successfully'
            ]);
        }
    }
}