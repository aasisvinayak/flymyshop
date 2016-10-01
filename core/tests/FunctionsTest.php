<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class FunctionsTest
 * Verify FlyMyShop functions are working
 */
class FunctionsTest extends TestCase
{
    /**
     * Test footer function is working
     *
     * @return void
     */
    public function testFooterFunction()
    {
        $this->assertTrue(function_exists('fmc_footer'));
    }

    /**
     * Test categories function
     *
     * @return void
     */
    public function testCategoriesFunction()
    {
        $categories=categories();
        $this->assertTrue(is_array($categories));
    }

    /**
     *  Test products function is working
     *
     * @return void
     */
    public function testProductsFunction()
    {
        $product = products(0, 0);
        $this->assertTrue(is_array($product));
    }

    /**
     * Test token function is working
     *
     * @return void
     */
    public function testTokenFunction()
    {
        $token= token();
        $this->assertTrue($token==csrf_field());
    }
}
