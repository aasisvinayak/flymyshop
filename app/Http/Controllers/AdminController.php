<?php

namespace App\Http\Controllers;

use App\User;
use Stripe\Charge;
use Stripe\Stripe;
use View;

/**
 * Class AdminController
 * Controller for admin area.
 *
 * @category Main
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     *
     * @return View
     */
    public function welcome()
    {
        return view('admin/welcome');
    }

    /**
     * Return paginated list of users.
     *
     * @return View
     */
    public function users()
    {
        $users = User::paginate(10);

        return view('admin/users', compact('users'));
    }

    /**
     * Return list of sales from stripe.
     *
     * @return View
     */
    public function sales()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charges = Charge::all();
        $charges = $charges['data'];

        foreach ($charges as $charge) {
            $email = User::GetEmailFromCustomerId($charge->customer);
            $charge->customer = $email;
        }

        return view('admin/sales', compact('charges'));
    }
}
