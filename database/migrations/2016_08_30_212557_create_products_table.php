<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id', 255);
            $table->string('title', 255);
            $table->string('make', 255);
            $table->integer('category_id')->unsigned();
            $table->mediumText('description');
            $table->longText('details');
            $table->string('image', 255);
            $table->string('image_name', 255);
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->integer('sold_count');
            $table->smallInteger('is_featured');
            $table->smallInteger('status');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
