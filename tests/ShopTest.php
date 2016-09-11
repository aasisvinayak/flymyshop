<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShopTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

    public function testExample()
    {
        $this->assertTrue(true);
    }

//    public function testHomePage()
//    {
//        $this->visit('/')
//             ->see('Shop');
//    }

    public function testHomePageListing()
    {
        $this->visit('/')->assertViewHas('products');
    }



}
