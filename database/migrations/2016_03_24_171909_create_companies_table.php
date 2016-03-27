<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('ID');
            $table->string('Name');
            $table->string('CurrencySymbol');
            $table->integer('CurrencyDecimalDigits');
            $table->integer('NumberDecimalDigits');
            $table->string('DecimalSeparator');
            $table->integer('HoursDecimalDigits');
            $table->integer('ItemCostPriceDecimalDigits');
            $table->integer('ItemSellingPriceDecimalDigits');
            $table->string('PostalAddress1');
            $table->string('PostalAddress2');
            $table->string('PostalAddress3');
            $table->string('PostalAddress4');
            $table->string('PostalAddress5');
            $table->string('GroupSeparator');
            $table->integer('RoundingValue');
            $table->integer('TaxSystem');
            $table->integer('RoundingType');
            $table->boolean('AgeMonthly');
            $table->boolean('DisplayInactiveItems');
            $table->boolean('WarnWhenItemCostIsZero');
            $table->boolean('WarnWhenItemQuantityIsZero');
            $table->boolean('WarnWhenItemSellingBelowCost');
            $table->integer('CountryId');
            $table->integer('CompanyEntityTypeId');
            $table->date('TakeOnBalanceDate');
            $table->boolean('EnableCustomerZone');
            $table->boolean('EnableAutomaticBankFeedRefresh');
            $table->string('ContactName');
            $table->string('Telephone');
            $table->string('Fax');
            $table->string('Mobile');
            $table->string('Email');
            $table->boolean('IsPrimarySendingEmail');
            $table->string('PostalAddress01');
            $table->string('PostalAddress02');
            $table->string('PostalAddress03');
            $table->string('PostalAddress04');
            $table->string('PostalAddress05');
            $table->string('CompanyInfo01');
            $table->string('CompanyInfo02');
            $table->string('CompanyInfo03');
            $table->string('CompanyInfo04');
            $table->string('CompanyInfo05');
            $table->boolean('IsOwner');
            $table->boolean('UseCCEmail');
            $table->string('CCEmail');
            $table->boolean('CheckForDuplicateCustomerReferences');
            $table->boolean('CheckForDuplicateSupplierReferences');
            $table->string('DisplayName');
            $table->boolean('DisplayInactiveCustomers');
            $table->boolean('DisplayInactiveSuppliers');
            $table->boolean('DisplayInactiveTimeProjects');
            $table->boolean('LockProcessing');
            $table->date('LockProcessingDate');
            $table->boolean('LockTimesheetProcessing');
            $table->date('LockTimesheetProcessingDate');
            $table->integer('TaxPeriodFrequency');
            $table->date('PreviousTaxPeriodEndDate');
            $table->date('PreviousTaxReturnDate');
            $table->boolean('UseNoreplyEmail');
            $table->boolean('AgeingBasedOnDueDate');
            $table->boolean('UseLogoOnEmails');
            $table->boolean('UseLogoOnCustomerZone');
            $table->string('City');
            $table->string('State');
            $table->string('Country');
            $table->integer('HomeCurrencyId');
            $table->integer('CurrencyId');
            $table->datetime('Created');
            $table->datetime('Modified');
            $table->boolean('Active');
            $table->string('TaxNumber');
            $table->string('RegisteredName');
            $table->string('RegistrationNumber');
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
        Schema::drop('companies');
    }
}
