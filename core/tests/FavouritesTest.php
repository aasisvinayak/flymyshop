<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
