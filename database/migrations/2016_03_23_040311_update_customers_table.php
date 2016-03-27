<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function ($table) {
            $table->string('DefaultPriceListName');
            $table->boolean('AcceptsElectronicInvoices');
            $table->boolean('HasActivity');
            $table->double('DefaultDiscountPercentage');
            $table->integer('DueDateMethodId');
            $table->integer('DueDateMethodValue');
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
