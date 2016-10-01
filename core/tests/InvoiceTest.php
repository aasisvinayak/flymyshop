<?php

/**
 * Class InvoiceTest
 * Verify functions related to invoice
 *
 */
class InvoiceTest extends TestCase
{
    /**
     * Test user can view all invoices linked to the user's account.
     *
     * @return void
     */
    public function testUserCanViewInvoices()
    {
        $this->userLogin();
        $this->randomPurchase();
        $this->visit('/account/order_history')
            ->assertViewHas('invoices');
    }

    /**
     * Test user can view the invoice details.
     *
     * @return void
     */
    public function testUserCanViewAnInvoice()
    {
        $this->userLogin();
        $this->randomPurchase();
        $this->visit('/account/order_history')
            ->assertViewHas('invoices')
            ->click('view-invoice-1')
            ->see('Order #');
    }
}
