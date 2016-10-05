<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('plugin_version', 255)->nullable();
            $table->string('plugin_author', 255)->nullable();
            $table->string('plugin_support_email', 255)->nullable();
            $table->string('plugin_description', 255)->nullable();
            $table->string('plugin_table', 255)->nullable();
            $table->string('plugin_config', 2555)->nullable();
            $table->smallInteger('status')->nullable();
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
        Schema::drop('plugins');
    }
}
