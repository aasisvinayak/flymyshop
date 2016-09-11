<?php

namespace App\Http\Controllers;

use App\Http\Models\Address;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use View;

/**
 * Class AddressController
 * CRUD controller for user address.
 *
 * @category Main
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class AddressController extends Controller
{
    /**
     * Display a listing of all the addresses.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $address = $user->addresses->all();

        return View::make('account.address.index')
            ->with('addresses', $address);
    }

    /**
     * Show the form for creating new address.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('account.address.create');
    }

    /**
     * Save new address entry to database.
     *
     * @param AddressRequest $request Address Request from user
     *
     * @return Response
     */
    public function store(AddressRequest $request)
    {
        $address = Address::create($request->all());
        $address->user_id = Auth::user()->id;
        $address->address_id = str_random(50);
        $address->save();

        if (isset($request)) {
            if ($request->next_page) {
                return Redirect::to('shop/check_out');
            }
        }

        Session::flash('message', 'Successfully added address');

        return Redirect::to('account/addresses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug address_id
     *
     * @return Response
     */
    public function edit($slug)
    {
        $address = Address::GetInfo($slug);

        return View::make('account.address.edit')
            ->with('address', $address[0]);
    }

    /**
     * Update the specified address in storage.
     *
     * @param AddressRequest $request request
     * @param string         $slug    address_id
     *
     * @return Response
     */
    public function update(AddressRequest $request, $slug)
    {
        $address = Address::GetInfo($slug);
        $address = $address[0];
        $address->update($request->all());
        Session::flash('message', 'Successfully updated address');

        return Redirect::to('account/addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug address_id
     *
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
