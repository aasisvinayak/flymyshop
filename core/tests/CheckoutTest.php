<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutTest extends TestCase
{

    public function testCheckoutButtonIsVisible()
    {

        $product = $this->getSampleProduct();
        $this->visit('shop/product/' . $product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->see('Checkout');

    }

    public function testCheckoutFailsWithoutProfileInfo()
    {
        $product = $this->getSampleProduct();
        //TODO: replace with Mock object
        $this->visit('shop/product/' . $product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->click('Checkout')
            ->seePageIs('login');
    }

    public function testCheckoutFailsWithoutLogin()
    {
        $this->userLogin();
        $product = $this->getSampleProduct();
        $this->visit('shop/product/' . $product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->click('Checkout')
            ->seePageIs('account/profile/edit');
    }


    public function testCheckoutFailsWithoutAddress()
    {
        $this->userLogin();
        $product = $this->getSampleProduct();
        $this->visit('shop/product/' . $product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->click('Checkout')
            ->seePageIs('account/profile/edit')
            ->type('Test', 'name')
            ->type('1234', 'phone')
            ->type('01/01/1970', 'dob')
            ->press('Update')
            ->seePageIs('account/addresses/create');
    }

// TODO mockery, use formfill

    public function testCheckoutFailsWithoutPaymentInfo()
    {
        $this->userLogin();
        $product = $this->getSampleProduct();
        $this->visit('shop/product/' . $product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->click('Checkout')
            ->seePageIs('account/profile/edit')
            ->type('Test', 'name')
            ->type('1234', 'phone')
            ->type('01/01/1970', 'dob')
            ->press('Update')
            ->seePageIs('account/addresses/create')
            ->type('Test', 'address_l1')
            ->type('Test', 'address_l2')
            ->type('Test', 'city')
            ->type('Test', 'state')
            ->type('Test', 'postcode')
            ->type('UK', 'country')
            ->press('Add Address');
//            ->seePageIs('account/payment_cards/create')
//            ->type('4242424242424242', 'card')
//            ->type('123', 'cvc')
//            ->select('2018', 'year')
//            ->press('Save card')
//            ->seePageIs('account');
    }
}
