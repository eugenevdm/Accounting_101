<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_account_categories', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('company_id');
            $table->integer('ID');
            $table->string('Description');
            $table->datetime('Modified');
            $table->datetime('Created');
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
        Schema::drop('bank_account_categories');
    }
}
