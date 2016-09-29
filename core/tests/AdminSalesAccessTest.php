<?php


class AdminSalesAccessTest extends TestCase
{
    public function testStatsAvailabe()
    {
        $this->adminLogin();
        $this->visit('admin/reports')
            ->assertViewHas('stats');
    }
}
