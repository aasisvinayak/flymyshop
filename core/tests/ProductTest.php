<?php


class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testProductPageIsViewable()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title);
    }

    public function testProductCanBeAddedToCart()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Buy')
            ->seePageIs('/shop/cart');
    }

    public function testProductCanBeAddedToFavourites()
    {
        $product = $this->getSampleProduct();
        $this->visit('shop/product/'.$product->product_id)
            ->see($product->title)
            ->press('Favourite')
            ->seePageIs('/shop/favourites');
    }
}
