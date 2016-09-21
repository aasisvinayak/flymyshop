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
}
