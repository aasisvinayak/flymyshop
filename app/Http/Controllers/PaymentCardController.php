<?php

namespace App\Http\Controllers;

use App\Http\Models\PaymentCard;
use Illuminate\Http\Request;
use Stripe\Token as StripeToken;
use App\Http\Requests,Auth;
use App\User;
use Stripe\Stripe;
use Stripe\Customer as StripeCustomer;

/**
 * Class PaymentCardController
 *
 * @category Main
 *
 * @package App\Http\Controllers
 *
 * @author acev <aasisvinayak@gmail.com>
 *
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class PaymentCardController extends Controller
{
    /**
     * Fetch all payment cards
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= Auth::user();
        $payment_cards=$user->payment_cards->all();
        return view('account.payment.index', compact("payment_cards"));
    }

    /**
     * Add a new payment method
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.payment.create');
    }

    /**
     * Store a payment method
     *
     * @param Request $request Payment Method Add Request
     *
     * @return Response
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

        if ($request->next_page) {
            return redirect('shop/check_out');
        }

        redirect('/account/payment_cards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug payment_card_id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $address = PaymentCard::GetInfo($slug);
        $address[0]->delete();
        Session::flash('message', 'Successfully deleted the entry!');
        return Redirect::to('account/addresses');
    }


}
