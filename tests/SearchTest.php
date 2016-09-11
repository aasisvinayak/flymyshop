<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;


    public function testShopSearch()
    {
        $this->visit('/')
            ->type('98','q')
            ->press('searchButton')
            ->seePageIs('/search')
            ->see('98');
    }

}
