<?php

namespace App\Http\Controllers;

use App\Http\Models\PaymentCard;
use Illuminate\Http\Request;
use Stripe\Token as StripeToken;
use App\Http\Requests,Auth;
use App\User;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;

class PaymentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        $payment_cards=$user->payment_cards->all();
        return view('account.payment.index', compact("payment_cards"));
    }


    public function orderPost(Request $request)
    {

//        $token = $input['stripeToken'];

//        try {
//            $user = User::find(1);
//            $user->newSubscription('main', 'monthly')->create($token);
//            return back()->with('success','Subscription is completed.');
//        } catch (Exception $e) {
//            return back()->with('success',$e->getMessage());
//        }

    }


    public function pay()
    {
        $user = User::find(1);
        return $user;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=Auth::user();

       $input = $request->all();
        $token = $input['stripeToken'];
        $token = StripeToken::retrieve($token, ['api_key' =>  env('STRIPE_SECRET')]);
        $options = array('description' => $user->email,
            "source" => $token,
        );
        $customer = StripeCustomer::create(
            $options, env('STRIPE_SECRET')
        );

        $payment_card=new PaymentCard;
        $payment_card->user_id=$user->id;
        $payment_card->card_id=$token->card->id;
        $payment_card->expiry_month=$token->card->exp_month;
        $payment_card->expiry_year=$token->card->exp_year;
        $payment_card->card_four_digit=$token->card->last4;
        $payment_card->vendor=$token->card->brand;
        $payment_card->country=$token->card->country;
        $payment_card->customer_id=$customer->id;
        $payment_card->save();

        $user->stripe_id=$customer->id;
        $user->card_brand=$token->card->brand;
        $user->card_last_four=$token->card->last4;
        $user->save();

        if($request->next_page){
            return redirect('shop/check_out');
        }

        redirect('/account/payment_cards');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
