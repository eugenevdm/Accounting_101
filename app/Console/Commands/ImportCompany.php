<?php

namespace App\Console\Commands;

use App\Account;
use App\AnalysisCategory;
use App\AnalysisType;
use App\Company;
use App\Customer;
use App\Invoice;
use App\Item;
use App\ItemCategory;
use App\Snowball\Utils;
use App\AccountCategory;
use App\CustomerCategory;
use Illuminate\Console\Command;

class ImportCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import a company's records using the Sage One Accounting API";

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $companies = Company::where('sync',1)->get();
        foreach ($companies as $company) {
            $this->import($company);
        }
    }

    private function import($company) {

        // Import dependencies

        $response = AccountCategory::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = AnalysisType::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = CustomerCategory::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = ItemCategory::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        // Import main

        $response = Account::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = AnalysisCategory::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = Customer::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = Item::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

        $response = Invoice::import($company);
        Utils::decho ( $response['status'] . ': ' . $response['results'] );

//        $response = Account::import($company);
//        Utils::decho ("Status of import: " . $response['status']);
//        Utils::decho ($response['results']);




    }

}
