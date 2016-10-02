<?php


/**
 * Class AdminOrdersAccessTest
 * 
 */
class AdminOrdersAccessTest extends TestCase
{

    /**
     * Test admin can view all orders
     *
     * @return void
     */
    public function testAdminCanViewOrders()
    {
        $this->randomPurchase();
        $this->adminLogin();
        $this->visit('admin/orders/')
            ->seePageIs('admin/orders/')
            ->assertViewHas('orders')
            ->click('view-order-1')
            ->see('Order #');
    }

    /**
     * Test admin user can change the status of an order
     *
     * @return void
     */
    public function testAdminCanUpdateOrderStatus()
    {
        $this->randomPurchase();
        $this->adminLogin();
        $this->visit('admin/orders/')
            ->seePageIs('admin/orders/')
            ->assertViewHas('orders')
           // ->select('2', 'update-order-status-1') to switch to an option that's not default
            ->press('Update')
            ->see('Order Status Updated!');
    }

}
