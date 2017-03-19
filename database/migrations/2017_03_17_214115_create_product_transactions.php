<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('product_transactions', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('product_id')->unsigned();
             $table->integer('qtd');
             $table->double('unit_value');
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
         Schema::drop('product_transactions');
     }
}
