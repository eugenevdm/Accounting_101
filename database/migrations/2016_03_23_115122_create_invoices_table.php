<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->datetime('DueDate');
            $table->string('FromDocument');
            $table->integer('FromDocumentId');
            $table->integer('FromDocumentTypeId');
            $table->boolean('AllowOnlinePayment');
            $table->string('Paid');
            $table->boolean('Status');
            $table->boolean('Locked');
            $table->integer('CustomerId');
            $table->string('CustomerName');
            $table->integer('SalesRepresentativeId');
            $table->string('SalesRepresentative');
            $table->integer('StatusId');
            $table->date('Modified');
            $table->date('Created');
            $table->date('Date');
            $table->boolean('Inclusive');
            $table->double('DiscountPercentage');
            $table->string('TaxReference');
            $table->string('DocumentNumber');
            $table->string('Reference');
            $table->string('Message');
            $table->double('Discount');
            $table->double('Exclusive');
            $table->double('Tax');
            $table->double('Rounding');
            $table->double('Total');
            $table->double('AmountDue');
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
            $table->boolean('Printed');
            $table->integer('CurrencyId');
            $table->double('ExchangeRate');
            $table->integer('TaxPeriodId');
            $table->boolean('Editable');
            $table->boolean('HasAttachments');
            $table->boolean('HasNotes');
            $table->boolean('HasAnticipatedDate');
            $table->date('AnticipatedDate');
            $table->string('Lines');
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
        Schema::drop('invoice');
    }
}
