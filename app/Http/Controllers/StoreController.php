<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests, View;

class StoreController extends Controller
{

    public function address()
    {

        return View::make('account.address');

    }

    public function addAddress()
    {
        return View::make('account.addressadd');
      //  echo env('IDME_CLIENT_ID');
    }
}
