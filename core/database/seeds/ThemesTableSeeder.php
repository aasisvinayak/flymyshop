<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            'name'    => 'default',
            'theme_version'    => '0.3',
            'theme_description'    => 'Vue based theme for FlyMyShop',
            'theme_author'    => 'acev',
            'status'    => 1,
        ]);

        DB::table('themes')->insert([
            'name'    => 'vue',
            'theme_version'    => '0.1',
            'theme_description'    => 'The default theme for FlyMyShop',
            'theme_author'    => 'acev',
            'status'    => 1,
        ]);
    }
}
