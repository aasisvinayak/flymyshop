<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class AdminSettingsTest
 */
class AdminSettingsTest extends TestCase
{

    //TODO: remove as the test below tests the same
    public function testAdminCanViewSettingsPage()
    {
        $this->adminLogin();
        $this->visit('/admin/settings')
            ->seePageIs('/admin/settings');

    }

    /**
     * Test admin user can change settings.
     */
    public function testAdminCanChangeSettings()
    {
        $this->adminLogin();
        $this->visit('/admin/settings')
            ->type('DEMO', 'SHOP_NAME')
            ->press('Save')
            ->seePageIs('/admin/settings')
            ->see('DEMO');
    }
}
