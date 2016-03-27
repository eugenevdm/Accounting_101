<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('Name');
            //$table->string('Category');
            $table->string('CategoryId');
            $table->boolean('Active');
            $table->double('Balance');
            $table->string('Description');
            $table->boolean('UnallocatedAccount');
            $table->boolean('IsTaxLocked');
            $table->datetime('Modified');
            $table->datetime('Created');
            $table->integer('AccountType');
            $table->boolean('HasActivity');
            $table->integer('DefaultTaxTypeId');
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
        Schema::drop('accounts');
    }
}
