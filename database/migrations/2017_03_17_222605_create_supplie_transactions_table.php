<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplieTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplie_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplie_id')->unsigned();
            $table->integer('qtd');
            $table->double('unit_value');
            $table->timestamps();
        });

        Schema::table('supplie_transactions', function($table) {
            $table->foreign('supplie_id')->references('id')->on('supplies');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supplie_transactions');
    }
}
