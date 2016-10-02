<?php

/**
 * Class AdminShopPageAccessTest
 */
class AdminShopPageAccessTest extends TestCase
{
    /**
     * Test admin can see the current shop pages.
     *
     * @return void
     */
    public function testAdminCanSeeCurrentPages()
    {
        $this->adminLogin();
        $this->visit('/admin/pages')
            ->assertViewHas('pages');
    }

    /**
     * Test admin can add a new shop page.
     *
     * @return void
     */
    public function testAdminCanAddPage()
    {
        $this->adminLogin();
        $this->visit('/admin/pages/create')
            ->type('Test Page', 'title')
            ->type('Test Content', 'content')
            ->press('Add Page')
            ->seePageIs('/admin/pages');
    }

    /**
     * Test admin can edit can existing page.
     *
     * @return void
     */
    public function testAdminCanEditPage()
    {
        $this->testAdminCanAddPage();
        $this->visit('/admin/pages')
            ->click('Edit')
            ->type('New Content', 'content')
            ->press('Update Page')
            ->seePageIs('/admin/pages')
            ->see('Page has been updated');
    }

    /**
     * Test admin delete an existing page.
     *
     * @return void
     */
    public function testAdminCanDeletePage()
    {
        $this->testAdminCanAddPage();
        $this->visit('/admin/pages')
            ->press('Delete')
            ->seePageIs('/admin/pages')
        ->see('Page has been deleted');
    }
}
