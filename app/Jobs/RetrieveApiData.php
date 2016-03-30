<?php

namespace App\Jobs;

use App\Company;
use App\ApiParams;
use App\Item;
use App\Sageone\Api;
use App\Snowball\Utils;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RetrieveApiData extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var
     */
    private $api;
    /**
     * @var
     */
    private $api_command;
    /**
     * @var
     */
    private $model;
    /**
     * @var
     */
    private $skip;
    /**
     * @var
     */
    private $top;
    /**
     * @var Company
     */
    private $company;

    /**
     * Create a new job instance.
     * @param $apiCommand
     * @param Company $company
     * @internal param $api_command
     * @internal param $skip
     * @internal param $top
     * @internal param Company $model
     */
    public function __construct($apiCommand, Company $company)
    {
        // Based on the $api_command and $company, get skip and top parameters
        $api_params = ApiParams::where('api_command', $apiCommand->command)
            ->where('company_id', $company->id)
            ->where('status', 'unprocessed')
            ->first();
        //dd($api_params);
        $this->api         = $apiCommand;
        $this->api_command = $apiCommand->command;
        $this->model       = $apiCommand->model;
        $this->skip        = $api_params->skip;
        $this->top         = $api_params->top;
        $this->company     = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Utils::decho("Now calling API in handle()...");
        $response = Api::apiCallQueue($this->api_command, $this->skip, $this->top, $this->company);
        // If API is successful then increment skip.
        if ($response['status'] == 'error') {
            Utils::decho("error in handle()");
            Utils::decho($response);
            die('Abnormal termination');
            //return $response;
        }

        $results = $response['results'];
        Utils::decho("Returned Results: " . $results->ReturnedResults);

        // Store data
        $class = "\\App\\{$this->model}";
        Utils::decho("Executing store() on $class");
        call_user_func_array([$class, 'store'], [$results, $this->company]);
        //$this->model::store($results, $this->company);

        //dd($results);
        if ($results->ReturnedResults < 100) {
            $api_params         = ApiParams::where('api_command', $this->api_command)
                ->where('company_id', $this->company->id)
                ->where('status', 'unprocessed')
                ->first();
            $api_params->status = 'completed';
            $api_params->save();
            Utils::decho('Done with bulk record importing.');
            $this->api->last_total_results = $results->TotalResults;
            $this->api->save();
//            Utils::decho('Done!');
//            dd($results);
        } else {
            $api_params       = ApiParams::where('api_command', $this->api_command)
                ->where('company_id', $this->company->id)
                ->where('status', 'unprocessed')
                ->first();
            $api_params->skip = $api_params->skip + 100;
            Utils::decho('Param increased: ' . $api_params->skip);
            $api_params->save();
            dispatch(new RetrieveApiData($this->api, $this->company));
        }

    }

    // http://[API URL]/api/[ver]/customer/Get?$skip=100&$top=100&$orderby=ID&apikey=39478ac6-ac2a-44d8-a31c-7e7e14af4de3& companyid=1


}
