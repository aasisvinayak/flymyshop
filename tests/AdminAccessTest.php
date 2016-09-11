<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminAccessTest extends TestCase
{


    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAccessAdminPageForAdmin()
    {
        $this->adminLogin();
        $this->visit('/admin/users')
            ->assertViewHas('users') ;
    }


//    public function testAccessAdminPageForUser()
//    {
//        $this->userLogin();
//        $this->visit('/admin/users')
//            ->assertViewMissing('users') ;
//    }

}
