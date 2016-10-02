<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AdminManagePaymentTest
 */
class AdminManagePaymentTest extends TestCase
{
    /**
     * Test admin user can view charges
     *
     * @return void
     */
    public function testAdminCanSeePayments()
    {
        $this->adminLogin();
        $this->visit('/admin/payments')
            ->assertViewHas('charges');
    }
}
