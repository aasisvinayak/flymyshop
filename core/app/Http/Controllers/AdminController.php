<?php

namespace App\Http\Controllers;

use App\Http\Models\Invoice;
use App\Http\Models\InvoiceItem;
use App\Http\Models\Product;
use App\Http\Models\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use View;

/**
 * Class AdminController
 * Controller for admin area.
 *
 * @category AppControllers
 *
 * @author acev <aasisvinayak@gmail.com>
 * @license https://github.com/aasisvinayak/flymyshop/blob/master/LICENSE  GPL-3.0
 *
 * @link https://github.com/aasisvinayak/flymyshop
 */
final class AdminController extends Controller
{
    /**
     * Display admin dashboard.
     *
     * @return View
     */
    public function welcome()
    {
        $reportValues = $this->generateReport()[0];

        return view('admin/welcome', $reportValues);
    }

    /**
     * Generate reports view.
     *
     * @return View
     */
    public function reports()
    {
        $reportValues = $this->generateReport()[0];

        return view('admin/reports', $reportValues);
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
        $orders = Invoice::IdDescending()->paginate(10); // to get the latest
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
     * Update status of the order.
     *
     * @param Request $request Status update request
     *
     * @return mixed
     */
    public function updateOrderStatus(Request $request)
    {
        $invoice = Invoice::findorFail($request->get('id'));
        $invoice->update(['status' => $request->get('status')]);

        return redirect('admin/orders');
    }

    /**
     * View individual order
     * TODO: reuse code in account controller. Move to helper.
     *
     * @param int $id order_id
     *
     * @return View
     */
    public function viewOrder($id)
    {
        $invoice = Invoice::findorFail($id);
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
            'admin/order',
            compact(
                'products',
                'order_no',
                'sub_total',
                'shipping',
                'tax',
                'invoice_date'
            )
        );
    }

    /**
     * Get sales stats for admin pages.
     *
     * @return array
     */
    protected function stats()
    {
        $today = Carbon::now();
        $lastYearThisDate = Carbon::now()->subYear();
        $lastMonthThisDate = Carbon::now()->subMonth();
        $yesterday = Carbon::now()->subDay();
        $invoiceItem = new InvoiceItem();
        $productsSoldAllTime = $this->returnNumber($invoiceItem->productsSold(0));
        $productsSoldInYear = $this->returnNumber($invoiceItem->productsSold($lastYearThisDate));
        $productsSoldInMonth = $this->returnNumber($invoiceItem->productsSold($lastMonthThisDate));
        $productsSoldToday = $this->returnNumber($invoiceItem->productsSold($yesterday));

        $invoice = new Invoice();

        $revenueAllTime = $this->returnNumber($invoice->sales(0));
        $revenueInYear = $this->returnNumber($invoice->sales($lastYearThisDate));
        $revenueInMonth = $this->returnNumber($invoice->sales($lastMonthThisDate));
        $revenueToday = $this->returnNumber($invoice->sales($yesterday));

        $invoiceCountAllTime = $this->returnNumber($invoice->invoiceCount(0));
        $invoiceCountInYear = $this->returnNumber($invoice->invoiceCount($lastYearThisDate));
        $invoiceCountInMonth = $this->returnNumber($invoice->invoiceCount($lastMonthThisDate));
        $invoiceCountToday = $this->returnNumber($invoice->invoiceCount($yesterday));


        $userCountAllTime = $this->returnNumber(User::userCount(0));
        $userCountInYear = $this->returnNumber(User::userCount($lastYearThisDate));
        $userCountInMonth = $this->returnNumber(User::userCount($lastMonthThisDate));
        $userCountToday = $this->returnNumber(User::userCount($yesterday));

        return compact(
            'productsSoldAllTime',
            'productsSoldInYear',
            'productsSoldInMonth',
            'productsSoldToday',
            'revenueAllTime',
            'revenueInYear',
            'revenueInMonth',
            'revenueToday',
            'invoiceCountAllTime',
            'invoiceCountInYear',
            'invoiceCountInMonth',
            'invoiceCountToday',
            'userCountAllTime',
            'userCountInYear',
            'userCountInMonth',
            'userCountToday'
        );
    }

    /**
     * Generate data for the last one year.
     *
     * @return mixed
     */
    protected function salesGraphData()
    {
        $lastYearThisDate = Carbon::now()->subYear();
        $invoices = Invoice::select('sub_total', 'created_at')
            ->where('created_at', '>', $lastYearThisDate)
            ->get()
            ->groupBy(
                function ($date) {
                    return Carbon::parse($date->created_at)->format('Y-m');
                }
            );

        foreach ($invoices as $item) {
            $sub_total = 0.00;
            foreach ($item as $entry) {
                $sub_total = $sub_total + $entry->sub_total;
            }
            $item['sum'] = $sub_total;
        }

        return $invoices->toArray();
    }

    /**
     * TODO: move as helper.
     *
     * @param $value
     * @return int|string
     */
    public function returnNumber($value)
    {
        return is_numeric($value) ? $value : 0;
    }

    /**
     * TODO: change to row by row approach (key->value) on database table settings.
     *
     * @return View
     */
    public function settings()
    {
        $settings = Setting::findorFail(1);

        return view('admin/settings', compact('settings'));
    }

    /**
     * TODO: update settings from admin panel than by manually editing .env.
     */
    public function updateSettings()
    {
    }

    /**
     * Fill-in the missing months with revenue =0.
     *
     * @param $graph
     * @return array
     */
    protected function getGraphWithCompleteValues($graph)
    {
        $formattedGraph = [];
        $current = Carbon::now();
        $month = $current->month;

        for ($i = 1; $i < 13; $i++) {
            $num_padded = sprintf('%02d', $i);
            if ($i > $month) {
                $year = $current->year;
                $num_padded = ($year - 1).'-'.$num_padded;
            } else {
                $num_padded = $current->year.'-'.$num_padded;
            }
            array_key_exists($num_padded, $graph) ?
                $formattedGraph[$num_padded] = $graph[$num_padded] :
                $formattedGraph[(string) $num_padded] = 0;
        }

        return $formattedGraph;
    }

    /**
     * Convert month number to name.
     *
     * @param $months
     * @return array
     */
    protected function getMonthNamesFromNumbers($months)
    {
        $monthNames = [];

        foreach ($months as $number) {
            $number = explode('-', $number);
            $mName = date('F', mktime(0, 0, 0, $number[1], 10));
            array_push($monthNames, $number[0].'-'.$mName);
        }

        return $monthNames;
    }

    /**
     * Extract the sum key from the main array and create a sub-array.
     *
     * @param $fullGraph
     * @return array
     */
    protected function getSumArray($fullGraph)
    {
        $valueArray = [];
        foreach ($fullGraph as $item) {
            array_push($valueArray, $item['sum']);
        }

        return $valueArray;
    }

    /**
     * Grab data for the last one year.
     *
     * @return array
     */
    protected function generateReport()
    {
        $graph = $this->salesGraphData();
        $stats = $this->stats();
        $fullGraph = $this->getGraphWithCompleteValues($graph);
        $months = array_keys($fullGraph);
        $formattedMonthName = [];

        foreach ($months as $month) {
            array_push($formattedMonthName, Carbon::createFromFormat('Y-m', $month)->toDateString());
        }

        $sumInArray = $this->getSumArray($fullGraph);
        $data = array_combine($formattedMonthName, $sumInArray);
        ksort($data);
        $monthNames = array_keys($data);
        $monthNames = $this->getMonthNamesFromNumbers($monthNames);
        $sumInArray = json_encode(array_values($data));
        $graphY = 'var value_array = '.($sumInArray).";\n";

        return [compact('stats', 'graphY', 'graph', 'monthNames')];
    }
}
