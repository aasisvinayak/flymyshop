<?php

use \Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'    => 'test@example.com',
            'password' => Hash::make('passw0rd'),
            ]);

        DB::table('users')->insert([
            'email'    => 'user@example.com',
            'password' => Hash::make('passw0rd'),
        ]);
    }
}
