<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, Validator, Input, Session, Auth, Hash, Mail;

class AdminController extends Controller
{

    public function welcome()
    {
       return view('admin/welcome');
    }
}
