<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'title' => 'SHOP_NAME',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'SITE_SUB_HEADING',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'MAIL_DRIVER',
            'value' => 'smtp',
        ]);


        DB::table('settings')->insert([
            'title' => 'MAIL_HOST',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAIL_PORT',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'MAIL_USERNAME',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'MAIL_PASSWORD',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAIL_ENCRYPTION',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAIL_FROM',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAIL_NAME',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'STRIPE_KEY',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'STRIPE_PUBLISHABLE_SECRET',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'STRIPE_SECRET',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'APP_ENV',
            'value' => 'local',
        ]);

        DB::table('settings')->insert([
            'title' => 'APP_DEBUG',
            'value' => 'true',
        ]);

        DB::table('settings')->insert([
            'title' => 'APP_URL',
            'value' => 'http://localhost',
        ]);


        DB::table('settings')->insert([
            'title' => 'THEME_FOLDER',
            'value' => 'default',
        ]);

        DB::table('settings')->insert([
            'title' => 'TAX_RATE',
            'value' => '0.00',
        ]);

        DB::table('settings')->insert([
            'title' => 'CURRENCY_SYMBOL',
            'value' => 'USD',
        ]);

        DB::table('settings')->insert([
            'title' => 'SHIPPING_CHARGE',
            'value' => '0.00',
        ]);



        DB::table('settings')->insert([
            'title' => 'SPARKPOST_SECRET',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAILCHIMP_APIKEY',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'MAILCHIMP_LIST_ID',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'FACEBOOK_PAGE_URL',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'TWITTER_PAGE_URL',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'YOUTUBE_CHANNEL_URL',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'INSTAGRAM_URL',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'TELEGRAM_BOT_TOKEN',
            'value' => 'BOT_TOKEN',
        ]);



        DB::table('settings')->insert([
            'title' => 'RECAPTCHA_PUBLIC_KEY',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'RECAPTCHA_PRIVATE_KEY',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'FACEBOOK_CLIENT_ID',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'title' => 'FACEBOOK_CLIENT_SECRET',
            'value' => '',
        ]);


        DB::table('settings')->insert([
            'title' => 'CACHE_DRIVER',
            'value' => 'file',
        ]);


        DB::table('settings')->insert([
            'title' => 'SESSION_DRIVER',
            'value' => 'file',
        ]);

        DB::table('settings')->insert([
            'title' => 'QUEUE_DRIVER',
            'value' => 'sync',

        ]);


        DB::table('settings')->insert([
            'title' => 'REDIS_HOST',
            'value' => '127.0.0.1',
        ]);


        DB::table('settings')->insert([
            'title' => 'REDIS_PASSWORD',
            'value' => 'null',
        ]);

        DB::table('settings')->insert([
            'title' => 'REDIS_PORT',
            'value' => '6379',
        ]);
    }
}
