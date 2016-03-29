<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrialBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->string('AccountNumber');
            $table->date('Date');
            $table->double('Debit');
            $table->double('Credit');
            $table->integer('AccountTypeId');
            $table->integer('AccountId');
            $table->integer('company_id');
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
        Schema::drop('trial_balance');
    }
}
