<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests, View, Validator, Input, Session, Redirect, Auth, Hash;
use App\User;

class WelcomeController extends Controller
{


    public function login()
    {
        return View::make('pages.login');
    }


    public function register()
    {
        return View::make('pages.register');
    }

    public function doRegister()
    {

        $rules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:6|confirmed',
            'password_confirmation' => 'required|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('register')
                ->withErrors($validator);
        } else {

            $user = new User;
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            
            Session::flash('message', 'Registered!');
            return Redirect::to('/login');

        }


    }

    public function doLogin()
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:6'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('message', 'Login failed!');
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            if (Auth::attempt($userdata)) {

                echo 'Welcome to our shop!';
                return redirect()->intended('/');


            } else {

                Session::flash('message', 'Login failed! Please check your credentials');
                return Redirect::to('login');
            }
        }
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::to('login');
    }

}
