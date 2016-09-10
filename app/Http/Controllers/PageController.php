<?php

namespace App\Http\Controllers;

use App\Http\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Requests;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pages= Page ::paginate(10);
        return view('admin/pages',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/add-page');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page= Page::create($request->all());
        $page->status=1;
        $page->page_id=str_random(50);
        $page->save();
        return redirect('admin/pages/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page= Page::findorFail($id);
        return view('shop/page',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page=Page::findorFail($id);
        return view('admin/edit-page',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $page= Page::findorFail($id);
        $page->update($request->all());
        return redirect('admin/pages/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::findorFail($id)->delete();
        return redirect('admin/pages/');
    }
}
