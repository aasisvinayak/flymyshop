<?php


class FavouritesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEmptyFavouritesRedirectToHomePage()
    {
        $this->visit('/shop/favourites')
            ->seePageIs('/')
            ->see('You have no saved items!');
    }


    public function testUserCanAddItemToFavourites()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Favourite')
            ->seePageIs('/shop/favourites')
            ->see($product['title']);
    }

    public function testUserCanDeleteProductFromFavourites()
    {
        $this->randomFavourite();
        $this->visit('/shop/favourites')
            ->press('Remove')
            ->seePageIs('/')
            ->see('You have no saved items!');
    }

}
