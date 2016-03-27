<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('Name');
            $table->integer('CategoryId')->nullable();
            $table->integer('SalesRepresentativeId');
            $table->string('TaxReference');
            $table->string('ContactName');
            $table->string('Telephone');
            $table->string('Fax');
            $table->string('Mobile');
            $table->string('Email');
            $table->string('WebAddress');
            $table->boolean('Active');
            $table->double('Balance');
            $table->double('CreditLimit');
            $table->integer('CommunicationMethod');
            $table->string('PostalAddress01');
            $table->string('PostalAddress02');
            $table->string('PostalAddress03');
            $table->string('PostalAddress04');
            $table->string('PostalAddress05');
            $table->string('DeliveryAddress01');
            $table->string('DeliveryAddress02');
            $table->string('DeliveryAddress03');
            $table->string('DeliveryAddress04');
            $table->string('DeliveryAddress05');
            $table->boolean('AutoAllocateToOldestInvoice');
            $table->boolean('EnableCustomerZone');
            $table->string('CustomerZoneGuid');
            $table->boolean('CashSale');
            $table->string('TextField1');
            $table->string('TextField2');
            $table->string('TextField3');
            $table->double('NumericField1');
            $table->double('NumericField2');
            $table->double('NumericField3');
            $table->boolean('YesNoField1');
            $table->boolean('YesNoField2');
            $table->boolean('YesNoField3');
            $table->date('DateField1');
            $table->date('DateField2');
            $table->date('DateField3');
            $table->integer('DefaultPriceListId');
            $table->datetime('Modified');
            $table->datetime('Created');
            $table->string('BusinessRegistrationNumber');
            $table->date('TaxStatusVerified');
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
        Schema::drop('customers');
    }
}
