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
}
