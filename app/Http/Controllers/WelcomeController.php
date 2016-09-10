<?php

namespace App\Http\Controllers;

use App\Http\Models\FailedLogin;
use App\Http\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Http\Requests, View, Validator, Input, Session, Redirect, Auth, Hash,Mail;
use App\User;
use Newsletter;


class WelcomeController extends Controller
{


    public function login()
    {
        if(Auth::check()){
            Session::flash('alert-info', 'Already logged in!');
            return  redirect('/');
        }

      else {
            return View::make('pages.login');
      }
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
            'password' => 'required|alphaNum|min:6',
            'g-recaptcha-response' => 'required|recaptcha',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Session::flash('alert-danger', 'Login failed!');
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $userdata = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );

            $ipAddress = $_SERVER['REMOTE_ADDR'];
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
                $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
            }

            $failCount=FailedLogin::throttle(Input::get('email'),$ipAddress)->count();

            if($failCount > 3){

                Session::flash('alert-danger', 'Account Locked : Too many invalid login attempts from this IP: '.$ipAddress.'! Please try again in   15 minutes.');
                return Redirect::to('login');
            }

            if (Auth::attempt($userdata, true)) {

                Session::save();
                echo 'Welcome to our shop!';
                return redirect()->intended('/');


            } else {

                //TODO change to Request::ip()

                FailedLogin::create([
                    'email'   => Input::get('email'),
                    'ip'   => $ipAddress,
                    'attempted_at' => Carbon::now()
                ]);

                Session::flash('alert-danger', 'Login failed! Please check your credentials');
                return Redirect::to('login');
            }
        }
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::to('login');
    }

    public function contact()
    {

        return View::make('pages.contact');

    }

    public function sendEmail(ContactFormRequest $request)
    {

        Mail::send('emails.contact',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'message' => $request->get('message')
            ), function($message)
            {
                $message->from(env('MAIL_FROM'));
                $message->to(env('MAIL_TO'), env('MAIL_NAME'))->subject('Contact Form');
            });

        return Redirect::to('contact')->with('message', 'Thanks for contacting us!');


    }

    public function search()
    {

        $rules = array(
            'q' => 'required|alphaNum|min:2',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Newsletter::subscribe(Input::get('q'));
            Session::flash('alert-danger',"Invalid search");
            return redirect('/');
        }

        else {

          $products =  Product::search(Input::get('q'));
            return view('shop/search',compact('products'));

        }

    }

    public function newsletter()
    {

        $rules = array(
            'email' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Newsletter::subscribe(Input::get('email'));
            Session::flash('alert-danger', "Invalid email");
            return redirect('/');
        } else {

            Newsletter::subscribe(Input::get('email'));
            Session::flash('alert-success', "Thank you for subscribing to our newsletter");
            return redirect('/');

        }
    }


}
