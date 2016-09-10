<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qty');
            $table->foreign('invoice_id')->references('id')
                ->on('invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')
                ->on('products');
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
        Schema::drop('invoice_items');
    }
}
