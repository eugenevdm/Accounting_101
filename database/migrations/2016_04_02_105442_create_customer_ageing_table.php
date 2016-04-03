<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAgeingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_ageing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('CustomerId');
            $table->datetime('Date');
            $table->double('Total');
            $table->double('Current');
            $table->double('Days30');
            $table->double('Days60');
            $table->double('Days90');
            $table->double('Days120Plus');
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
        Schema::drop('customer_ageing');
    }
}
