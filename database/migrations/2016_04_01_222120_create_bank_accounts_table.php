<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('company_id');
            $table->integer('ID');
            $table->string('Name');
            $table->string('BankName');
            $table->string('AccountNumber');
            $table->string('BranchName');
            $table->string('BranchNumber');
            $table->string('CategoryId')->nullable();
            $table->boolean('Active');
            $table->boolean('Default');
            $table->double('Balance');
            $table->string('Description');
            $table->integer('BankFeedAccountId')->nullable();
            $table->date('LastTransactionDate');
            $table->date('LastImportDate');
            $table->boolean('HasTransactionsWaitingForReview');
            $table->integer('DefaultPaymentMethodId');
            $table->integer('PaymentMethod');
            $table->datetime('Modified');
            $table->datetime('Created');
            $table->integer('CurrencyId');
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
        Schema::drop('bank_accounts');
    }
}
