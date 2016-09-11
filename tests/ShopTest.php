<?php


class ShopTest extends TestCase
{
    /**
     * Test homepage is visible.
     *
     * @test
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')->see('Shop');
    }

    /**
     * Test homepage has products listing.
     *
     * @test
     *
     * @return void
     */
    public function testHomePageListing()
    {
        $this->visit('/')->assertViewHas('products');
    }
}
