<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{   
    public function vendor_products(Request $request) {
        $products = Product::where('vendor_id', $request->id)->latest('id')->get();
        return response()->json($products);
    }
    
    public function create() {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ]);
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
                return response()->json([
                    'message' => 'Product Successfully Added',
                    'status' => 201
                ]);
            }
        }
    }

    public function edit(Request $request) {
        $product = Product::where('id', $request->id)->with('category')->first();
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function update(Request $request) {
        
        $product = Product::where('id', $request->id)->first();
        $image_name = $request->product_image;
        
        if(isset($request->new_image) || $request->new_image) {
            //remove first the old image
            $image = public_path('/assets/images/products/') . $request->product_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('new_image');
            $image_name = $file->getClientOriginalName();
            $save_file = $file->move(public_path().'/assets/images/products', $image_name);
        }
        
        $product->vendor_id = $request->vendor_id;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->stock = $request->stock;
        $product->amount = $request->amount;
        $product->description = $request->description;
        $save = $product->save();
        
        if($save) {
            return response()->json([
                'status' => 201,
                'message' => 'Product Successfully Updated.'
            ]);
        }
    }

    public function destroy(Product $id) {
        $image = public_path('/assets/images/products/') . $id->product_image;
        $remove_image = @unlink($image);
        $delete = $id->delete();

        if($delete && $remove_image) return response()->json([
            'status' => 201,
            'message' => 'Product Successfully Deleted'
        ]);
    }

 }