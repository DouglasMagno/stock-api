<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of product');
            $table->double('price')->default(0)->comment('Price of product');
            $table->double('qtd')->default(0)->comment('Current quantity of product');
            $table->string('unit')->comment('Suffix units for product like kg, cm, gal');
            $table->string('format')->comment('Type format units like double or int');
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
        Schema::dropIfExists('products');
    }
}
