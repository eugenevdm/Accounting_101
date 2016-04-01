<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesRepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reps', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Name');
            $table->boolean('Active');
            $table->string('Email');
            $table->string('Mobile');
            $table->string('Telephone');
            $table->datetime('Created');
            $table->datetime('Modified');
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
        Schema::drop('sales_reps');
    }
}
