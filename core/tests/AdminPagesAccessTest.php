<?php

/**
 * Class AdminPagesAccessTest
 * TODO: remove and add the relevant tests to individual scenarios
 */
class AdminPagesAccessTest extends TestCase
{
    /**
     * Verify that admin can view shop users
     *
     * @return void
     */
    public function testAdminCanViewUsers()
    {
        $this->adminLogin();
        $this->visit('admin/users')
            ->assertViewHas('users');
    }

    /**
     * Verify that admin can view products
     *
     * @return void
     */
    public function testAdminCanViewProducts()
    {
        $this->adminLogin();
        $this->visit('admin/products')
            ->assertViewHas('products');
    }

    /**
     * Test that admin can view categories
     *
     * @return void
     */
    public function testAdminCanViewCategories()
    {
        $this->adminLogin();
        $this->visit('admin/categories')
            ->assertViewHas('categories');
    }

    /**
     * Test that admin can view shop pages
     *
     * @return void
     */
    public function testAdminCanViewShopPages()
    {
        $this->adminLogin();
        $this->visit('admin/pages')
            ->assertViewHas('pages');
    }

    /**
     * Test that admin can view orders.
     *
     * @return void
     */
    public function testAdminCanViewOrders()
    {
        $this->adminLogin();
        $this->visit('admin/orders')
            ->assertViewHas('orders');
    }

    /**
     * Test that admin can view current product stock.
     *
     * @return void
     */
    public function testAdminCanViewStocks()
    {
        $this->adminLogin();
        $this->visit('admin/stocks')
            ->assertViewHas('products');
    }

    /**
     * Test that admin can view settings information.
     *
     * @return void
     */
    public function settings()
    {
        $this->adminLogin();
        $this->visit('admin/settings')
            ->assertViewHas('settings');
    }
}
