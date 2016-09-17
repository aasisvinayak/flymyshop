<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    /*
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function testExample()
    {
        $this->assertTrue(true);
    }

//    public function testUserRegistration()
//    {
//        $this->visit('/register')
//            ->type('example@domain.com', 'email')
//            ->type('password', 'password')
//           ->type('password', 'confirm_password')
//            ->press('Register')
//            ->seePageIs('/login');
//    }
}
