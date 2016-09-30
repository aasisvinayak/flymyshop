<?php


class CheckoutTest extends TestCase
{
    public function testCheckoutButtonIsVisible()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->see('Checkout');
    }

    public function testCheckoutFailsWithoutProfileInfo()
    {
        $product = $this->getSampleProduct();
        //TODO: replace with Mock object
        $this->visit('shop/product/'.$product->product_id)
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
        $this->visit('shop/product/'.$product->product_id)
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
        $this->visit('shop/product/'.$product->product_id)
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
        $this->addAddress();
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
           ->seePageIs('account/payment_cards/create');
     //   echo   $this->response->getOriginalContent();

    }

    public function testCheckOut()
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

       // $this->deleteSamplePaymentCard();
    }
}
