<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pharmacy_products', function (Blueprint $table) {
                 $table->increments('id');
                 $table->unsignedInteger('product_id');
                 $table->unsignedInteger('pharmacy_id');
                 $table->integer('price');
                 $table->integer('quantity');
                 $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
                 $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onUpdate('cascade')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacy_products');
    }
}
