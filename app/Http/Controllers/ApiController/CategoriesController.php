<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.category.categories');
    }

    /**
     * DATA TABLE for category list
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request) {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                    ->addColumn('category_image', function($row) {
                        return '<img height="60" width="60" src="../../../assets/images/categories/'. $row->category_image .'" >';
                    })
                    ->addColumn('action', function($row){
                           $btn = '<a href="/edit_category/'.$row->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="/destroy_category/'.$row->id.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->addColumn('created_at', function($row){
                        return date('F d, Y',strtotime($row->created_at));
                    })
                    ->rawColumns(['category_image', 'action'])
                    ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required',
            'category_image.*' => 'mimes:jpg,png,jpeg'
        ]);

        if($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/categories', $image_name);

            $save = Category::create([
                'category_name' => $request->category_name,
                'category_image' => $image_name,
            ]);

            if($save) {
                return redirect('/categories');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $id)
    {
        //
        return view('backend.category.edit_category', ['category' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        if($request->hasFile('category_image')) {
            //remove first the old image
            $image = public_path('/assets/images/categories/') . $request->old_image;
            $remove_image = @unlink($image);
            //store the new image
            $file = $request->file('category_image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path().'/assets/images/categories', $image_name);

            $category->category_name = $request->category_name;
            $category->category_image = $image_name;
            $save = $category->save();  
        } else {
            $category->category_name = $request->category_name;
            $category->category_image = $request->old_image;
            $save = $category->save();
        }
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $id)
    {
        $image = public_path('/assets/images/categories/') . $id->category_image;
        $remove_image = @unlink($image);
        $delete = $id->delete();
        if($delete && $remove_image) return redirect('/categories');
    }
}