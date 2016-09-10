<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, Validator, Input, Session, Auth, Hash, Mail;
use App\Http\Models\UserType;
use App\User;
use Stripe\Charge;
use Stripe\Stripe;

class AdminController extends Controller
{

    public function welcome()
    {
      return view('admin/welcome');
    }

    public function users()
    {
        $users=User::paginate(10);
        return view('admin/users',compact('users'));
    }

    public function sales()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charges=Charge::all();
        $charges= $charges['data'];

        foreach ($charges as $charge){
            $email=User::GetEmailFromCustomerId($charge->customer);
            $charge->customer=$email;
        }
       return view('admin/sales', compact('charges'));
        
    }
}
