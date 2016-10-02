<?php

/**
 * Class LoginTest.
 */
class LoginTest extends TestCase
{
    protected $user;

    /**
     * See login page is viewable.
     * Not required any more because of the test below.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->visit('/login')
            ->see('email')
            ->see('password');
    }

    /**
     * Test login using a seed data.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->visit('/login')
            ->type('test@example.com', 'email')
            ->type('passw0rd', 'password')
            ->press('Login')
            ->seePageIs('/home')
            ->see('Account');
    }
}
