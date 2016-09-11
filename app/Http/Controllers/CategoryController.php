<?php

namespace App\Http\Controllers;

use App\Http\Requests, App\Http\Models\Category;
use \Illuminate\Http\Request, View, Validator, Input, Session, Redirect, Auth, Hash,Mail;

/**
 * Class CategoryController
 * CRUD for category (/admin/categories)
 *
 * @category Main
 *
 * @package App\Http\Controllers
 *
 * @author acev <aasisvinayak@gmail.com>
 *
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class CategoryController extends Controller
{
    /**
     * Paginated listing of shop categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(10);
        return view('admin/categories', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add-category');
    }

    /**
     * Store a newly created resource in storage.
     * TODO: Change to CategoryRequest
     *
     * @return Response
     */
    public function store()
    {
        $rules = array(
            'title'       => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('shop/categories/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data=Input::all();
            $data['status']=1;
            $data['category_id']=str_random(50);
            $data['parent_id']="";
            Category::create($data);
        }

        return redirect('admin/categories/');

    }

    /**
     * Display the specified category.
     *
     * @param int $id category id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category= Category::findorFail($id);
        return $category;
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id category id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findorFail($id);
         return view('admin.edit-category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request update request
     * @param int                      $id      category id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Category::findorFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id category id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findorFail($id)->delete();
    }
}
