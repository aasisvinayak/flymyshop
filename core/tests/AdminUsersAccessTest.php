<?php


/**
 * Class AdminUsersAccessTest.
 */
class AdminUsersAccessTest extends TestCase
{
    /**
     * Test admin user can view all the site users.
     *
     * @return void
     */
    public function testAdminCanViewUsers()
    {
        $this->adminLogin();
        $this->visit('admin/users/')
            ->seePageIs('admin/users/')
            ->assertViewHas('users');
    }

    /**
     * Test admin user cannot disable admin (current user) account.
     *
     * @return void
     */
    public function testAdminCannotDisableAdminAccount()
    {
        $this->randomPurchase();
        $this->adminLogin();
        $this->visit('admin/users/')
            ->seePageIs('admin/users/')
            ->assertViewHas('users')
            // ->select('2', 'update-status-status-1') to switch to an option that's not default
            ->press('update-user-status-btn-1')
            ->see('Cannot disable admin (you) account!');
    }

    /**
     * Test admin user can disable/enable users.
     *
     * @return void
     */
    public function testAdminCanUpdateUserStatus()
    {
        $this->randomPurchase();
        $this->adminLogin();
        $this->visit('admin/users/')
            ->seePageIs('admin/users/')
            ->assertViewHas('users')
            // ->select('2', 'update-status-status-1') to switch to an option that's not default
            ->press('update-user-status-btn-2')
            ->see('User Status Updated!');
    }
}
