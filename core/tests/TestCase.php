<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Http\Models\Product;
use App\User;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    private $mock;
    protected $baseUrl = 'http://localhost';
    use DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function adminLogin()
    {
        $user = User::findorFail(1);
        $this->be($user);
    }

    public function userLogin()
    {
        $user = User::findorFail(2);
        $this->be($user);
    }

    public function getSampleProduct()
    {
        $product = Product::findorFail(1);
        return $product;
    }

    public function randomCart()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Buy');

       // return $product;
    }

    public function randomFavourite()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Favourite');
        // return $product;
    }


    public function addAddress()
    {
        $this->userLogin();
        $this->visit('account/addresses/create')
            ->type('Test', 'address_l1')
            ->type('Test', 'address_l2')
            ->type('Test', 'city')
            ->type('Test', 'state')
            ->type('Test', 'postcode')
            ->type('UK', 'country')
            ->press('Add Address');
    }




    public function addMockPaymentCardInfo()
    {
        $mock = Mockery::mock(\App\Http\Models\PaymentCard::class);
        $input = [
            'user_id' => '1',
            'customer_id'=> 'badjhasbjhda',
            'card_id' => 'ahwo91hshgaonGslnafJxnalk',
            'card_four_digit' => '1234',
            'expiry_month' => '04',
            'expiry_year' => '2020',
            'vendor' => 'Test',
            'country' => 'Test'
        ];
        $mock->shouldReceive('create')
            ->once()->with($input)->andReturnSelf();
    }







}
