<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('product_id',255);
            $table->string('title',255);
            $table->string('make',255);
            $table->string('category_id',255);
            $table->string('description',255);
            $table->string('details',255);
            $table->string('image',255);
            $table->double('price');
            $table->smallInteger('is_featured');
            $table->smallInteger('status');
            $table->timestamps();
//            $table->foreign('category_id')
//                ->references('category_id')->on('categories')
//                ->onDelete('cascade');
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
