<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('products_id');
            $table->integer('category_id');
            $table->integer('manufacture_id');
            $table->string('products_name');
            $table->string('products_name_arabic');
            $table->string('products_short_description');
            $table->string('products_short_description_arabic');
            $table->longText('products_long_description');
            $table->longText('products_long_description_arabic');
            $table->float('products_price');
            $table->string('products_image');
            $table->string('products_size');
            $table->string('products_color');
            $table->integer('publication_status');
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
        Schema::dropIfExists('tbl_products');
    }
}
