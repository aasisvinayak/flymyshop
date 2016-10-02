<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Http\Models\Product;
use App\User;

/**
 * Class TestCase
 */
class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
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

    /**
     * Become admin user
     */
    public function adminLogin()
    {
        $user = User::findorFail(1);
        $this->be($user);
    }

    /**
     * Become regular user
     *
     * @return void
     */
    public function userLogin()
    {
        $user = User::findorFail(2);
        $this->be($user);
    }

    /**
     * Return a sample product
     *
     * @return Product
     */
    public function getSampleProduct()
    {
        $product = Product::findorFail(1);
        return $product;
    }

    /**
     * Add a random product to cart
     *
     * @return void
     */
    public function randomCart()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Buy');
    }

    /**
     * Add a random product to Favourite
     *
     * @return void
     */
    public function randomFavourite()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Favourite');
    }


    /**
     * Add Test Address
     *
     * @return void
     */
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


    /**
     * Mock Payment cart
     *
     * @return \App\Http\Models\PaymentCard
     */
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

    public function randomPurchase()
    {
        $this->expectsEvents(\App\Events\ProcessPayment::class);
        $this->expectsEvents(\App\Events\OrderPlaced::class);
        $this->userLogin();

        $product = $this->getSampleProduct();
        $this->addAddress();

        \App\Http\Controllers\PaymentCardController::addSamplePaymentCard();

        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->click('Checkout')
            ->seePageIs('account/profile/edit')
            ->type('Test', 'name')
            ->type('1234', 'phone')
            ->type('01/01/1970', 'dob') // note that this field is already pre-filled
            ->press('Update')
            ->seePageIs('account');

        \App\Http\Controllers\PaymentCardController::deleteSamplePaymentCard();

    }
}
