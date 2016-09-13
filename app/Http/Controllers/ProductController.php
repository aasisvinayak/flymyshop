<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Requests\ProductRequest;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/**
 * Class ProductController.
 *
 * @category Main
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class ProductController extends Controller
{
    /**
     * Paginated listing of all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('admin/products', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::lists('title', 'category_id');

        return view('admin/add-product', compact('categories_list'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param ProductRequest $request Product Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $category_id = Category::select('id')
        ->where('category_id', '=', $request['category_id'])
        ->get()->toArray();
        $category_id = $category_id[0]['id'];
        $request['category_id'] = $category_id;
        $request['product_id'] = str_random(50);
        $request['status'] = 1;
        $request['stock'] = 0;
        $request['sold_count'] = 0;
        $randomFileName = str_random(50);
        $extension = '';

        if ($request->file('image')->isValid()) {
            $destinationPath = 'uploads';
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $randomFileName.'.'.$extension;
            $request->file('image')->move(public_path($destinationPath), $fileName);
        }

        $request ['image'] = $randomFileName;
        $request ['image_name'] = $randomFileName.'.'.$extension;
        Product::create($request->all());

        return redirect('admin/products/');
    }

    /**
     * Display the specified product.
     *
     * @param int $id page id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorFail($id);
        return $product; // TODO display in view
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id product id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findorFail($id);
        $categories_list = Category::lists('title', 'category_id');
        return view('admin.edit-product', compact('product', 'categories_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request product request
     * @param int                      $id      product id
     *
     * @return Redirect
     */
    public function update(Request $request, $id)
    {
        Product::findorFail($id)->update($request->all());
        return redirect('admin/products');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id product id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        Product::findorFail($id)->delete();
        return redirect('admin/products');
    }
}
