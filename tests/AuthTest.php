<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use \Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    /**
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
