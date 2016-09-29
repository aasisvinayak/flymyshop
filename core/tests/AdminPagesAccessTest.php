<?php


class AdminPagesAccessTest extends TestCase
{
    public function testAdminCanViewUsers()
    {
        $this->adminLogin();
        $this->visit('admin/users')
            ->assertViewHas('users');
    }

    public function testAdminCanViewProducts()
    {
        $this->adminLogin();
        $this->visit('admin/products')
            ->assertViewHas('products');
    }

    public function testAdminCanViewCategories()
    {
        $this->adminLogin();
        $this->visit('admin/categories')
            ->assertViewHas('categories');
    }

    public function testAdminCanViewShopPages()
    {
        $this->adminLogin();
        $this->visit('admin/pages')
            ->assertViewHas('pages');
    }

    public function testAdminCanViewOrders()
    {
        $this->adminLogin();
        $this->visit('admin/orders')
            ->assertViewHas('orders');
    }

    public function testAdminCanViewStocks()
    {
        $this->adminLogin();
        $this->visit('admin/stocks')
            ->assertViewHas('products');
    }

    public function settings()
    {
        $this->adminLogin();
        $this->visit('admin/settings')
            ->assertViewHas('settings');
    }
}
