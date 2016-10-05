<?php

use Illuminate\Database\Seeder;

class PluginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plugins')->insert([
            'name'    => 'Sample',
            'plugin_version'    => '0.0.1',
            'author_name'    => 'acev',
            'plugin_support_email'    => 'test@example.com',
            'plugin_description'    => 'The sample plugin for shop',
            'plugin_table'    => '',
            'plugin_config'    => '',
            'status'    => 1,
        ]);

        DB::table('plugins')->insert([
            'name'    => 'Sample',
            'plugin_version'    => '0.0.1',
            'author_name'    => 'acev',
            'plugin_support_email'    => 'test@example.com',
            'plugin_description'    => 'The sample plugin for shop',
            'plugin_table'    => '',
            'plugin_config'    => '',
            'status'    => 1,
        ]);

        DB::table('plugins')->insert([
            'name'    => 'Test',
            'plugin_version'    => '0.0.1',
            'author_name'    => 'acev',
            'plugin_support_email'    => 'test@example.com',
            'plugin_description'    => 'The test plugin for shop',
            'plugin_table'    => '',
            'plugin_config'    => '',
            'status'    => 1,
        ]);

        DB::table('plugins')->insert([
            'name'    => 'ProcessOrder',
            'plugin_version'    => '0.0.1',
            'author_name'    => 'acev',
            'plugin_support_email'    => 'test@example.com',
            'plugin_description'    => 'Process order plugin',
            'plugin_table'    => '',
            'plugin_config'    => '',
            'status'    => 1,
        ]);


    }
}
