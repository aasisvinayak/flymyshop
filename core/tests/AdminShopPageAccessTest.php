<?php


class AdminShopPageAccessTest extends TestCase
{
    public function testSeeCurrentPages()
    {
        $this->adminLogin();
        $this->visit('/admin/pages')
            ->assertViewHas('pages');
    }

    public function testListPages()
    {
        $this->adminLogin();
        $this->visit('/admin/pages')
            ->assertViewHas('pages');
    }

    public function testAdminCanAddPage()
    {
        $this->adminLogin();
        $this->visit('/admin/pages/create')
            ->type('Test Page', 'title')
            ->type('Test Content', 'content')
            ->press('Add Page')
            ->seePageIs('/admin/pages');
    }

    public function testAdminCanEditPage()
    {
        $this->testAdminCanAddPage();
        $this->visit('/admin/pages')
            ->click('Edit')
            ->type('New Content','content')
            ->press('Update Page')
            ->seePageIs('/admin/pages')
            ->see('Page has been updated');;
    }

    public function testAdminCanDeletePage()
    {
        $this->testAdminCanAddPage();
        $this->visit('/admin/pages')
            ->press('Delete')
            ->seePageIs('/admin/pages')
        ->see('Page has been deleted');
    }
}
