<?php

namespace App\Http\Controllers;

use App\Http\Models\PaymentCard;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Stripe\Customer as StripeCustomer;
use Stripe\Token as StripeToken;

/**
 * Class PaymentCardController.
 *
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class PaymentCardController extends Controller
{
    /**
     * Fetch all payment cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $payment_cards = $user->payment_cards->all();

        return view('account.payment.index', compact('payment_cards'));
    }

    /**
     * Add a new payment method.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.payment.create');
    }

    /**
     * Store a payment method.
     *
     * @param Request $request Payment Method Add Request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $token = $input['stripeToken'];
        $token = StripeToken::retrieve($token, ['api_key' =>  env('STRIPE_SECRET')]);
        $options = ['description' => $user->email,
            'source'              => $token,
        ];
        $customer = StripeCustomer::create(
            $options, env('STRIPE_SECRET')
        );

        $payment_card = new PaymentCard();
        $payment_card->user_id = $user->id;
        $payment_card->card_id = $token->card->id;
        $payment_card->expiry_month = $token->card->exp_month;
        $payment_card->expiry_year = $token->card->exp_year;
        $payment_card->card_four_digit = $token->card->last4;
        $payment_card->vendor = $token->card->brand;
        $payment_card->country = $token->card->country;
        $payment_card->customer_id = $customer->id;
        $payment_card->save();
        $user->stripe_id = $customer->id;
        $user->card_brand = $token->card->brand;
        $user->card_last_four = $token->card->last4;
        $user->save();

        if ($request->next_page) {
            return redirect('shop/check_out');
        }

        return redirect('/account/payment_cards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug payment_card_id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $payment_method = PaymentCard::GetInfo($slug)->get(0);
        $this->authorize('delete', $payment_method);
        $payment_method->delete();
        $request->session()->flash('message', 'Successfully deleted card!');

        return redirect('account/addresses');
    }


    /**
     * Add a sample payment card for testing
     *  TODO: return the payment card id for code reuse if required
     *
     * @return void
     */
    public static function addSamplePaymentCard()
    {
        $payment_card = new PaymentCard();
        $payment_card->user_id = 2;
        $payment_card->card_id = 'ahwo91hshgaonGslnafJxnalk';
        $payment_card->expiry_month = '12';
        $payment_card->expiry_year = '2020';
        $payment_card->card_four_digit = '1234';
        $payment_card->vendor = 'visa';
        $payment_card->country = 'uk';
        $payment_card->customer_id = 'cus_32327891872192';
        $payment_card->save();
    }

    /**
     * Delete the sample card
     * TODO: allow deletion by passing the id of the sample card.
     *
     * @return void
     */
    public static function deleteSamplePaymentCard()
    {
        $paymentCard= new \App\Http\Models\PaymentCard();
        $paymentCard->destroy(1);
    }

}
