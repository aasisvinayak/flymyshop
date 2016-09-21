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
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
final class AddressController extends Controller
{
    /**
     * Display a listing of all the addresses.
     *
     * @return Response
     */
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses->all();

        return view('account.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating new address.
     *
     * @return Response
     */
    public function create()
    {
        return view('account.address.create');
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
                return redirect('shop/check_out');
            }
        }

        $request->session()->flash('message', 'Successfully added address!');

        return redirect('account/addresses');
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
        $address = Address::GetInfo($slug)->get(0);
        $this->authorize('show', $address);

        return view('account.address.edit', compact('address'));
    }

    /**
     * Update the specified address in storage.
     *
     * @param AddressRequest $request request
     * @param string         $slug    address_id
     *
     * @return Redirect
     */
    public function update(AddressRequest $request, $slug)
    {
        $address = Address::GetInfo($slug)->get(0);
        $this->authorize('update', $address);
        $address->update($request->all());
        $request->session()->flash('message', 'Successfully updated address');

        return redirect('account/addresses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug address_id
     * @param Request $request
     * @param string $slug address_id
     *
     * @return Redirect
     */
    public function destroy(Request $request, $slug)
    {
        $address = Address::GetInfo($slug)->get(0);
        $this->authorize('delete', $address);
        $address->delete();
        $request->session()->flash('message', 'Successfully deleted the entry!');

        return redirect('account/addresses');
    }
}
