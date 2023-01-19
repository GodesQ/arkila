<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    //
    public function index() {
        return view('backend.product.products');
    }

    //
    public function table(Request $request) {

        if(session()->get('role') == 'vendor') {
            $data = Product::select('*')->where('vendor_id', session()->get('id'))->latest();
        } else {
            $data = Product::select('*')->latest();
        }
        
        return Datatables::of($data)
                    ->addColumn('product_image', function($row) {
                        return '<img height="60" width="60" src="../../../assets/images/products/'. $row->product_image .'" >';
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="/edit_product/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="/destroy_product/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                        return date('F d, Y',strtotime($row->created_at));
                    })
                    ->rawColumns(['product_image', 'action'])
                    ->toJson();
    }

    public function create() {
        $categories = Category::all();
        $vendors = Vendor::limit(25)->get();
        return view('backend.product.add-product', compact('categories', 'vendors'));
    }

    public function store(Request $request) {
        $request->validate([
            "category_id" => 'required',
            "product_name" => 'required',
            "product_image" => 'required',
            "stock" => 'required',
            "amount" => 'required',
            "description" => 'required'
        ]);

        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/products', $image_name);

            $save = Product::create([
                "vendor_id" => $request->vendor_id,
                "category_id" => $request->category_id,
                "product_name" => $request->product_name,
                "product_image" => $image_name,
                "stock" => $request->stock,
                "amount" => $request->amount,
                "description" => $request->description
            ]);

            if($save) {
                return redirect('/products')->with('success', 'Create Successfully');
            }
        }
    }

    public function edit(Product $id) {
        $categories = Category::all();
        $vendors = Vendor::limit(25)->get();
        return view('backend.product.edit-product', ['product' => $id, 'categories' => $categories, 'vendors' => $vendors]);
    }

    public function update(Request $request) {
        // dd($request->all());
        $product = Product::where('id', $request->id)->first();
        $image_name = $request->old_image;
        
        if(isset($request->product_image)) {
            //remove first the old image
            $image = public_path('/assets/images/products/') . $request->old_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('product_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/products', $image_name);
        }
        
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_image = $image_name;
        $product->stock = $request->stock;
        $product->amount = $request->amount;
        $product->description = $request->description;
        $save = $product->save();

        return back()->with('success', 'Update Successfully.');
    }

    public function destroy(Product $id) {
        $image = public_path('/assets/images/products/') . $id->product_image;
        $remove_image = @unlink($image);
        $delete = $id->delete();

        if($delete && $remove_image) return redirect('/products');
    }

 }