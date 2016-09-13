<?php

namespace App\Http\Controllers;

use App\Http\Models\Invoice;
use App\Http\Models\Product;
use App\User;
use Illuminate\Http\Request;
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
    public function payment()
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

    /**
     * List of orders.
     *
     * @return View
     */
    public function orders()
    {
        $orders = Invoice::IdDescending()->paginate(10);
        foreach ($orders as $item) {
            $item->user_id = User::findorFail($item->user_id)->email;

            if (is_null($item->status)) {
                $item->status = 'Order placed';
            } else {
                switch ($item->status) {
                    case 1:
                        $item->status = 'Currently being processed!';
                        break;
                    case 2:
                        $item->status = 'At Warehouse';
                        break;
                    case 3:
                        $item->status = 'Dispatched';
                        break;
                    case 4:
                        $item->status = 'Cancelled & Refund Pending';
                        break;
                    case 5:
                        $item->status = 'Cancelled & Refund Issued';
                        break;
                    default:
                        $item->status = 'Status Unavailable';
                }
            }

            if ($item->status == 1) {
                $item->status = 'Order placed';
            }
        }

        return view('admin/orders', compact('orders'));
    }

    /**
     * Update status of the order
     *
     * @param Request $request Status update request
     * 
     * @return mixed
     */
    public function updateOrderStatus(Request $request)
    {
        $invoice=Invoice::findorFail($request->get('id'));
        $invoice->update(array('status'=>$request->get('status')));
        return redirect('admin/orders');
    }

    /**
     * View individual order
     * TODO: reuse code in account controller
     *
     * @param int $id order_id
     *
     * @return View
     */
    public function viewOrder($id)
    {
        $invoice=Invoice::findorFail($id);
        $invoice_items = $invoice->invoice_items->all();
        $order_no = $invoice->order_no;
        $products = [];

        $sub_total = $invoice->sub_total;
        $shipping = $invoice->shipping;
        $tax = $invoice->tax;
        $invoice_date = $invoice->created_at;

        foreach ($invoice_items as $item) {
            $product = Product::findorFail($item->product_id);
            $product['qty'] = $item->qty;
            array_push($products, $product);
        }

        return view(
            'admin/order', compact(
                'products', 'order_no', 'sub_total', 'shipping', 'tax', 'invoice_date'
            )
        );
    }
}
