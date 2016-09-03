<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\ProductRequest;

use  App\Http\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product= Product::all();
        return $product;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list=Category::lists('title','category_id');
        return view('shop/add-product',compact('categories_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request['product_id']=  str_random(50);
        $request['status']=1;
        $randomFileName=str_random(50);
        $extension="";


        if ($request->file('image')->isValid()) {
            $destinationPath = 'uploads';
            $extension =  $request->file('image')->getClientOriginalExtension();
            $fileName = $randomFileName . '.' . $extension;
            $request->file('image')->move($destinationPath, $fileName);
        }

        $request ['image']=$randomFileName;
        $request ['image_name']=$randomFileName. '.' .$extension;
        Product::create($request->all());
        return redirect('shop/products/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findorFail($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findorFail($id);
        $categories_list=Category::lists('title','category_id');
        return view('shop.edit-product',compact('product','categories_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Product::findorFail($id)->update($request->all());
        return redirect('shop/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findorFail($id)->delete();
    }



}
