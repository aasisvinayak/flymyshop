<?php


/**
 * Class RegisterTest.
 */
class RegisterTest extends TestCase
{
    /**
     * Verify user registration is working.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $this->visit('/register')
            ->type('unitTest@domain.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home');
    }
}
