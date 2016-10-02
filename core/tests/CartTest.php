<?php

/**
 * Class CartTest
 */
class CartTest extends TestCase
{
    /**
     * Verify that if the cart is empty the user gets redirected to homepage.
     *
     * @return void
     */
    public function testEmptyCartRedirectToHomePage()
    {
        $this->visit('/shop/cart')
            ->seePageIs('/')
            ->see('Empty Cart!');
    }

    /**
     * Verify that user can add a product to cart.
     *
     * @return void
     */
    public function testUserCanAddItemToCart()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->see($product['title']);
    }

    /**
     * Verify that user can update number of units of a product that is already
     * in the cart.
     *
     * @return void
     */
    public function testUserCanUpdateProductQuantityInCart()
    {
        $this->randomCart();
        $this->visit('/shop/cart')
            ->type('2', 'qty')
            ->press('Update')
            ->seePageIs('/shop/cart')
            ->seeInField('qty',2);
    }

    /**
     * Verify that user can remove a product from the cart.
     *
     * @return void
     */
    public function testUserCanRemoveProductFromCart()
    {
        $this->randomCart();
        $this->visit('/shop/cart')
            ->press('Remove')
            ->see('Empty Cart!');
    }

}
