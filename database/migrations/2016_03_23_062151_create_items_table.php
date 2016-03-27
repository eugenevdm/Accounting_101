<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('Description');
            $table->integer('CategoryId')->nullable();
            $table->string('Code');
            $table->boolean('Active');
            $table->double('PriceInclusive');
            $table->double('PriceExclusive');
            $table->boolean('Physical');
            $table->integer('TaxTypeIdSales');
            $table->string('TaxTypeSales');
            $table->integer('TaxTypeIdPurchases');
            $table->string('TaxTypePurchases');
            $table->double('LastCost');
            $table->double('AverageCost');
            $table->double('QuantityOnHand');
            $table->boolean('HasAttachments');
            $table->boolean('HasActivity');
            $table->string('Unit');
            $table->integer('ItemReportingGroupId_Sales');
            $table->string('ItemReportingGroupSales');
            $table->integer('ItemReportingGroupId_Purchases');
            $table->string('ItemReportingGroupPurchases');
            $table->string('TextUserField1');
            $table->string('TextUserField2');
            $table->string('TextUserField3');
            $table->double('NumericUserField1');
            $table->double('NumericUserField2');
            $table->double('NumericUserField3');
            $table->date('DateUserField1');
            $table->date('DateUserField2');
            $table->date('DateUserField3');
            $table->boolean('YesNoUserField1');
            $table->boolean('YesNoUserField2');
            $table->boolean('YesNoUserField3');
            $table->datetime('Modified');
            $table->integer('MajorIndustryCodeId');
            $table->double('GPPercentage');
            $table->double('GPAmount');
            $table->string('ItemReportingGroupPurchasesName');
            $table->string('ItemReportingGroupSalesName');
            $table->string('AdditionalItemPrices');
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
        Schema::drop('items');
    }
}
