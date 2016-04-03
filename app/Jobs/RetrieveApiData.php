<?php

namespace App\Jobs;

use App\ApiJob;
use App\Company;
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

    private $post;

    /**
     * Create a new job instance.
     * @param $apiCommand
     * @param Company $company
     * @param string $post
     * @internal param $api_command
     * @internal param $skip
     * @internal param $top
     * @internal param Company $model
     */
    public function __construct($apiCommand, Company $company, $post = "")
    {
        // Based on the $api_command and $company, get skip and top parameters
        $api_params = ApiJob::where('api_command', $apiCommand->command)
            ->where('company_id', $company->id)
            ->where('status', 'unprocessed')
            ->first();
        $this->api         = $apiCommand;
        $this->api_command = $apiCommand->command;
        $this->model       = $apiCommand->model;
        $this->skip        = $api_params->skip;
        $this->top         = $api_params->top;
        $this->company     = $company;
        $this->post        = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Utils::decho("Now calling API in handle()...");

        $results = Api::apiCall($this->api_command, $this->skip, $this->top, $this->company, $this->post);

        echo "<pre>";
        print_r($results);
        echo "</pre>";

        Utils::decho("Returned Results: " . $results->ReturnedResults);

        // Store data
        $class = "\\App\\{$this->model}";
        Utils::decho("Executing store() on $class");
        call_user_func_array([$class, 'store'], [$results->Results, $this->company]);

        if ($results->ReturnedResults < config('sageoneapi.max_results')) {
            $api_params         = ApiJob::where('api_command', $this->api_command)
                ->where('company_id', $this->company->id)
                ->where('status', 'unprocessed')
                ->first();
            $api_params->status = 'completed';
            $api_params->save();
            Utils::decho('Done with bulk record importing.');
            $this->api->last_total_results = $results->TotalResults;
            $this->api->save();
        } else {
            $api_params       = ApiJob::where('api_command', $this->api_command)
                ->where('company_id', $this->company->id)
                ->where('status', 'unprocessed')
                ->first();
            $api_params->skip = $api_params->skip + config('sageoneapi.max_results');
            Utils::decho('Param increased: ' . $api_params->skip);
            $api_params->save();
            dispatch(new RetrieveApiData($this->api, $this->company, $this->post));
        }

    }

}
