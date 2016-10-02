<?php

/**
 * Class FavouritesTest
 */
class FavouritesTest extends TestCase
{
    /**
     * Verify that user is redirected to homepage if the favourites list is empty.
     *
     * @return void
     */
    public function testEmptyFavouritesRedirectToHomePage()
    {
        $this->visit('/shop/favourites')
            ->seePageIs('/')
            ->see('You have no saved items!');
    }


    /**
     * Test user can add a product to favourite.
     *
     * @return void
     */
    public function testUserCanAddItemToFavourites()
    {
        $product=$this-> getSampleProduct();
        $this->visit('/shop/product/'.$product['product_id'])
            ->press('Favourite')
            ->seePageIs('/shop/favourites')
            ->see($product['title']);
    }

    /**
     * Test user can delete product from favourite.
     *
     * @return void
     */
    public function testUserCanDeleteProductFromFavourites()
    {
        $this->randomFavourite();
        $this->visit('/shop/favourites')
            ->press('Remove')
            ->seePageIs('/')
            ->see('You have no saved items!');
    }

}
