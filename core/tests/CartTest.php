<?php


class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEmptyCartRedirectToHomePage()
    {
        $this->visit('/shop/cart')
            ->seePageIs('/')
            ->see('Empty Cart!');
    }

    public function testUserCanAddItemToCart()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Buy')
            ->seePageIs('/shop/cart')
            ->see($product['title']);
    }

    public function testUserCanUpdateProductQuantityInCart()
    {
        $this->randomCart();
        $this->visit('/shop/cart')
            ->type('2', 'qty')
            ->press('Update')
            ->seePageIs('/shop/cart')
            ->seeInField('qty',2);
    }

    public function testUserCanRemoveProductFromCart()
    {
        $this->randomCart();
        $this->visit('/shop/cart')
            ->press('Remove')
            ->see('Empty Cart!');
    }

}
