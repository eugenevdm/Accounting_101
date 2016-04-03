<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporting_groups', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->integer('company_id');
            $table->integer('ParentReportingGroupId');
            $table->string('Description');
            $table->integer('AccountCategoryId');
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
        Schema::drop('reporting_groups');
    }
}
