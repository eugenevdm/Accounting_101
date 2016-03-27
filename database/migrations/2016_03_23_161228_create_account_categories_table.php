<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_categories', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('Description');
            $table->string('Comment');
            $table->datetime('Modifed');
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
        Schema::drop('account_categories');
    }
}
