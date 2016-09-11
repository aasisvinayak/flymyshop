<?php


class AdminAccessTest extends TestCase
{
    /**
     * Check user with admin privileges can access
     * admin page.
     *
     * @test
     *
     * @since  version 0.1
     *
     * @return void
     */
    public function testAccessAdminPageForAdmin()
    {
        $this->adminLogin();
        $this->visit('/admin/users')
            ->assertViewHas('users');
    }

    /**
     * Check user without admin privileges cannot access admin pages.
     *
     * @test
     *
     * @return void
     */
    public function testAccessAdminPageForUser()
    {
        $this->userLogin();
        $this->visit('/admin/users')
            ->assertViewMissing('users');
    }
}
