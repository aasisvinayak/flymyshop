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
        $this->user = new User();
    }

    public function testCreateUser()
    {
        $this->be( $this->user);
        $this->visit('/')
            ->see('Account');
//        dd(User::count());

    }



}
