<?php

/**
 * Class AdminSalesAccessTest
 */
class AdminSalesAccessTest extends TestCase
{
    /**
     * Test admin can view shop stats.
     *
     * @return void
     */
    public function testAdminCanViewShopStats()
    {
        $this->adminLogin();
        $this->visit('admin/reports')
            ->assertViewHas('stats');
    }
}
