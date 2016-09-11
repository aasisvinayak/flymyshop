<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('sub_title', 255);
            $table->string('email', 255);
            $table->string('phone', 255);
            $table->string('address_l1', 255);
            $table->string('address_l2', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('country', 255);
            $table->string('currency', 255);
            $table->decimal('tax', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->string('fb', 255);
            $table->string('twitter', 255);
            $table->string('gplus', 255);
            $table->string('youtube', 255);
            $table->string('instagram', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }
}
