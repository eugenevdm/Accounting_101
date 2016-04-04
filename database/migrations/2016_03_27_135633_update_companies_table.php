<?php

use Illuminate\Database\Migrations\Migration;

class UpdateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function ($table) {
            $table->boolean('sync');
            $table->string('username');
            $table->string('password');
            $table->string('api_key');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
