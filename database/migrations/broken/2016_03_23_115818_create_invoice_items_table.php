<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->integer('SelectionId');
            $table->integer('TaxTypeId');
            $table->string('Description');
            $table->integer('LineType');
            $table->double('Quantity');
            $table->double('UnitPriceExclusive');
            $table->string('Unit');
            $table->double('UnitPriceInclusive');
            $table->double('TaxPercentage');
            $table->double('DiscountPercentage');
            $table->double('Exclusive');
            $table->double('Discount');
            $table->double('Tax');
            $table->double('Total');
            $table->string('Comments');
            $table->integer('AnalysisCategoryId1');
            $table->integer('AnalysisCategoryId2');
            $table->integer('AnalysisCategoryId3');
            $table->string('TrackingCode');
            $table->integer('CurrencyId');
            $table->double('UnitCost');
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
        Schema::drop('invoice_items');
    }
}
