<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    /*
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    protected $user;

    public function setUp()
    {
        parent::setUp();
        //$this->user = new User();
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }

//  te
}
