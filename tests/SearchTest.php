<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Search for seed entry.
     *
     * @test
     *
     * @return void
     */
    public function testShopSearch()
    {
        $this->visit('/')
            ->type('98', 'q')
            ->press('searchButton')
            ->seePageIs('/search')
            ->see('98');
    }
}
