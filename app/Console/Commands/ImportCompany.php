<?php

namespace App\Console\Commands;

use App\Item;
use App\ApiJob;
use App\Account;
use App\Company;
use App\Invoice;
use App\Customer;
use App\ApiCommand;
use App\Sageone\Api;
use App\AnalysisType;
use App\ItemCategory;
use App\Snowball\Utils;
use App\AccountCategory;
use App\AnalysisCategory;
use App\CustomerCategory;
use App\Jobs\RetrieveApiData;
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
            $this->getApiTotals($company);
        }
    }

    private function getApiTotals($company) {

        $apiCommands = ApiCommand::where('cron_include', true)->orderBy('cron_order')->get();

        foreach($apiCommands as $apiCommand) {

            // Bug in API if you specify top=1 for ReportingGroup you get 1 as TotalResults
            $results = Api::apiCall($apiCommand->command, 0, 100, $company);

            $totalResults = $results->TotalResults;
//            dd($totalResults);

            Utils::decho("TotalResults: " . $totalResults);

            if ($apiCommand->last_total_results <> $totalResults) {

                $api_params = new ApiJob();
                $api_params->api_command = $apiCommand->command;
                $api_params->total_results = $totalResults;
                $api_params->skip = $apiCommand->last_total_results;
                $api_params->top = config('sageoneapi.max_results');
                $api_params->company_id = $company->id;
                $api_params->status = 'unprocessed';
                $api_params->save();

                dispatch(new RetrieveApiData($apiCommand, $company));

            }

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

    }

}
