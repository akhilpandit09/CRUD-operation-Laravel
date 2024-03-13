<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(){
        return view('products.index',['products' => product::get()]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        // dd($request -> all());

        // validate data
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif/max:1000',
        ]);

        // upload image
        $imageName = time(). '.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        // insert data into database
        $product = new product;
        $product -> image = $imageName;
        $product -> name = $request -> name;
        $product -> description = $request -> description;

        $product ->save();
        return back()->withSuccess(trans("Product addedd successfuly"));
    }

    public function edit($id){
        $product = product::where('id', $id) -> first();
        return view ('products.edit',['product' => $product]);
    }
    public function update(Request $request, $id){
        // dd($request->all());
        $request -> validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif/max:1000',
        ]);

        $product = product::where('id', $id) -> first();

        // upload image
        if(isset($request->image)){
            $imageName = time(). '.'.$request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product -> image = $imageName;
        }

        // update name and description
        $product -> name = $request -> name;
        $product -> description = $request -> description;

        $product ->save();
        return back()->withSuccess(trans("Product updated successfuly"));
    }
    public function destroy($id){
        $product = product::where('id', $id) -> first();
        $product-> delete();
        return back()->withSuccess(trans('Product deleted successfully!!!'));
    }

    public function show($id){
        $product = product::where('id', $id) -> first();
        return  view('products.show', ['product'=>$product]);
    }
}
