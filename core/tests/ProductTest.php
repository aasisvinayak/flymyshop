<?php

/**
 * Class ProductTest
 */
class ProductTest extends TestCase
{
    /**
     * Verify that a sample product page is visible.
     *
     * @return void
     */
    public function testProductPageIsViewable()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title);
    }

    /**
     * Test that a product can be added to cart.
     * TODO: move to cart check
     *
     * @return void
     */
    public function testProductCanBeAddedToCart()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart');
    }

    /**
     * Verify that product can be added to favourites.
     * TODO: move to favourites check
     *
     * @return void
     */
    public function testProductCanBeAddedToFavourites()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Favourite')
            ->seePageIs('/shop/favourites');
    }
}
