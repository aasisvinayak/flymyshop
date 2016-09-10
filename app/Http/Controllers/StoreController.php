<?php

namespace App\Http\Controllers;
use App\Http\Models\Category;
use App\Http\Models\Page;
use App\Http\Models\Product;
use App\Http\Models\Invoice;
use App\Http\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use \League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use \League\OAuth2\Client\Provider\GenericProvider;
use App\Http\Requests, View, Input, Cart;
use Stripe\Charge;
use Stripe\Stripe;


class StoreController extends Controller
{

    public function address()
    {
        return View::make('account.address');
    }

    public function home()
    {

        //  echo session('shop_currency');
        $products=Product::featured();
        return view('pages/home',compact('products'));

    }

    public function addAddress()
    {

        $url = env('API_AUTH_URL') . "authorize?client_id=" . env('CLIENT_ID') . "&redirect_uri=" . env('CLIENT_RETURN_URL') . "&response_type=code";
        return View::make('account.addressadd')->with('url', $url);
    }

    public function updateAddress()
    {

        $provider = new GenericProvider([
            'clientId' => env('CLIENT_ID'),
            'clientSecret' => env('CLIENT_SECRET'),
            'redirectUri' => 'http://localhost:8084/update_address',
            'urlAuthorize' => env('API_AUTH_URL') . "authorize",
            'urlAccessToken' => env('API_AUTH_URL') . "access_token",
            'urlResourceOwnerDetails' => env('API_URL') . "api/merchant/data"

        ]);

        if (!isset($_GET['code'])) {
            $authorizationUrl = $provider->getAuthorizationUrl();
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authorizationUrl);
            exit;

            // add csrf state check

        } else {

            try {
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => Input::get('code')
                ]);

                echo $accessToken->getToken() . "\n";

                echo $accessToken->getExpires() . "\n";

                // save to database

                $resourceOwner = $provider->getResourceOwner($accessToken);
                var_export($resourceOwner->toArray()); // test

            } catch (IdentityProviderException $e) {
                exit($e->getMessage());
            }

        }

    }


    public function refreshToken()
    {

        $provider = new GenericProvider([
            'clientId' => env('CLIENT_ID'),
            'clientSecret' => env('CLIENT_SECRET'),
            'redirectUri' => 'http://localhost:8084/update_address',
            'urlAuthorize' => env('API_AUTH_URL') . "authorize",
            'urlAccessToken' => env('API_AUTH_URL') . "access_token",
            'urlResourceOwnerDetails' => env('API_URL') . "api/merchant/data"

        ]);


        $currentAccessToken = ""; //get from database

        $newAccessToken = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $currentAccessToken->getRefreshToken()
        ]);


    }


    public function authUserDetails()
    {

    }

    public function productDetails( $slug)
    {
        $product_id= Product::GetID($slug)->get()->toArray();
        $product=Product::findorFail($product_id[0]['id']);
        return View::make('shop.product',compact('product'));

    }

    public function category($slug)
    {

        $category_info= Category::GetInfo($slug)->get()->toArray();
        $category_name="";


        $products="";
        if(count($category_info)>0){
            $category_id= $category_info[0]['id'];
            $category_name= $category_info[0]['title'];
            $products=Product::ByCategory($category_id)->paginate(12);
//            $category= Category::findorFail($category_id);
//            $products=$category->products->paginate(12);
        }
        
        return view('shop/products',compact('products','category_name'));



    }

    public function cart()
    {
        $cart_content= Cart::content();
        if(count($cart_content)<1){
            Session::flash('alert-warning', 'Empty Cart!');
              return   redirect('/');
        }
        else{

            $total_price=0.00;
            foreach ($cart_content as $item){
                $total_price=(filter_var($item->options->price, FILTER_SANITIZE_NUMBER_FLOAT,
                    FILTER_FLAG_ALLOW_FRACTION)*$item->qty)+$total_price;
            }
            return view('shop/cart',compact('cart_content','total_price'));
        }

    }

    public function addCart()
    {
        $item=Input::get('product_id');
        $product_summary=Product::ProductSummaryProductID($item)
            ->get()->toArray()[0];
      Cart::add($item, $product_summary['title'], 1,filter_var($product_summary['price'], FILTER_SANITIZE_NUMBER_FLOAT,
          FILTER_FLAG_ALLOW_FRACTION) , $product_summary);
        return redirect('/shop/cart');
    }

    public function removeFromCart()
    {
        $rowId=Input::get('row_id');
        Cart::remove($rowId);
        return redirect('/shop/cart');
    }

    public function updateCart()
    {
        $rowId=Input::get('row_id');
        $qty=Input::get('qty');
        Cart::update($rowId,$qty);
        return redirect('/shop/cart');
    }

    public function addFavourite()
    {
        $item=Input::get('product_id');
        $product_summary=Product::ProductSummaryProductID($item)
            ->get()->toArray()[0];
        Cart::instance('favourites')->add($item, $product_summary['title'], 1,filter_var($product_summary['price'], FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION), $product_summary);
        return redirect('/shop/favourites');

    }

    public function removeFavourite()
    {
        $rowId=Input::get('row_id');
        Cart::instance('favourites')->remove($rowId);
        return redirect('/shop/favourites');

    }

    public function favourites()
    {

        $favourites= Cart::instance('favourites')->content();
        if(count($favourites)<1){
            Session::flash('alert-warning', 'You have no saved items!');
            return   redirect('/');
        }
        else{
            return view('shop/favourite',compact('favourites','total_price'));
        }

    }


    public function checkOut()
    {
        $cart_content= Cart::content();
        $total_price=0.00;

        foreach ($cart_content as $item){
            $total_price=(filter_var($item->options->price, FILTER_SANITIZE_NUMBER_FLOAT,
                        FILTER_FLAG_ALLOW_FRACTION)*$item->qty)+$total_price;
        }

        $user=Auth::user();

        //TODO catch error and set which card to use
        $user->charge($total_price*100);

        $invoice = new Invoice;
        $invoice->user_id=$user->id;
        $invoice->invoice_id=str_random(50);
        $invoice->order_no=rand(pow(10, 9) - 1, pow(10, 10) - 1);
        $invoice->sub_total=$total_price;
        $invoice->tax=env('TAX_RATE')*$total_price;
        $invoice->save();
        $invoice_id=$invoice->id;

        foreach ($cart_content as $item){
            $invoice_item = new InvoiceItem;
            $invoice_item->invoice_id= $invoice_id;
            $invoice_item->product_id=$item->options->id;
            $invoice_item->qty=$item->qty;
            $invoice_item->save();
        }

        Cart::destroy();
        Session::flash('alert-success', 'Thank you for shopping with us!');
        return redirect('/account');
    }


    public function currency(Request $request, $iso)
    {
        $request->session()->flush();
        Session::put("shop_currency", $iso);
        return redirect(url()->previous());
    }

    public function emptyCart()
    {
        Cart::destroy();
        return redirect('/');
    }

    public function page($title,$page_id)
    {
        $page=Page::GetPage($page_id)[0];
        return view('shop/page',compact('page'));
    }



}
