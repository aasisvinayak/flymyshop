<?php

/**
 * Class CheckoutTest
 */
class CheckoutTest extends TestCase
{
    /**
     * Verify that the checkout button is visible
     *
     * @return false
     */
    public function testCheckoutButtonIsVisible()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->see('Checkout');
    }

    /**
     * Verify that checkout requires user to login.
     *
     * @return void
     */
    public function testCheckoutFailsWithoutLogin()
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

    /**
     * Verify that checkout requires user's profile info.
     *
     * @return void
     */
    public function testCheckoutFailsWithoutProfileInfo()
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

    /**
     * Verify that checkout requires user to have at least one address on record
     *
     * @return void
     */
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

// TODO mockery to return the expected, use formfill

    /**
     * Verify that the user cannot checkout without a payment card on record.
     *
     * @return void
     */
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

    /**
     * Test that checkout works smoothly if the requirements are met.
     *
     * @return void
     */
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

        \App\Http\Controllers\PaymentCardController::deleteSamplePaymentCard();
    }
}
