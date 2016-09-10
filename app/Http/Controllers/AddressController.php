<?php

namespace App\Http\Controllers;

use App\Http\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator,Session,Redirect, Input, View ;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user=Auth::user();
        $address = $user->addresses->all();
        return View::make('account.address.index')
            ->with('addresses', $address);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('account.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(AddressRequest $request)
    {
        $address = Address::create($request->all());
        $address->user_id = Auth::user()->id;
        $address->address_id = str_random(50);
        $address->save();

         if($request->next_page){
             return Redirect::to('shop/check_out');
         }

        Session::flash('message', 'Successfully added address');
        return Redirect::to('account/addresses');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($slug)
    {
        $address = Address::GetInfo($slug);
       // return ;
        // show the view and pass the nerd to it

        return View::make('account.address.edit')
            ->with('address', $address[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(AddressRequest $request, $slug)
    {
            $address =  Address::GetInfo($slug);
            $address=$address[0];
            $address->update($request->all());
            Session::flash('message', 'Successfully updated address');
            return Redirect::to('account/addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($slug)
    {
        $address = Address::GetInfo($slug);
        $address[0]->delete();
        Session::flash('message', 'Successfully deleted the entry!');
        return Redirect::to('account/addresses');
    }
}
