<?php

namespace App\Http\Controllers;

use App\ApiCommand;
use App\ApiJob;
use App\Sageone\Api;
use App\Http\Requests;
use App\CustomerAgeing;
use App\Jobs\RetrieveApiData;
use App\Snowball\Utils;
use Illuminate\Support\Facades\Input;

class CustomerAgeingController extends Controller
{

    /**
     * Display customer ageing sorting by Customer Name
     * See: http://stackoverflow.com/questions/23530051/laravel-eloquent-sort-by-relation-table-column
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $customerageing = CustomerAgeing::current($this->company->id)->get();

        $customerageing = CustomerAgeing::join('customers as c', 'c.ID', '=', 'customer_ageing.CustomerId')
            ->orderBy('c.Name')
            ->select('customer_ageing.*')       // just to avoid fetching anything from joined table
            //->with('customers')         // if you need options data anyway
            ->get();

        //dd($customerageing);

        return view('customerageing.index', compact('customerageing'));
    }

    public function select()
    {
        return view('customerageing.select');
    }

    /**
     * Get a customer ageing report based on the selected parameters
     *
     * Example date range: Date Range:    01/03/2016  to  28/02/2017
     */
    public function store()
    {
        $input = Input::all();
        unset($input['_token']);

        // Add calculated fields
        if ($input['status'] == 'both') {
            $input['IncludeActive']   = true;
            $input['IncludeInactive'] = true;
        } elseif ($input['status'] == 'active') {
            $input['IncludeActive']   = true;
            $input['IncludeInactive'] = false;
        } elseif ($input['status'] == 'inactive') {
            $input['IncludeActive']   = false;
            $input['IncludeInactive'] = true;
        }
        unset($input['status']);

        // Set defaults for this report, see https://accounting.sageone.co.za/api/1.1.1/Help/Api/POST-CustomerAgeing-GetSummary
        // In spite of trying options 0 to 4, it always returns the current data. Having no value displays all.
        //$input['AgeingPeriod']       = 0;
        $input['BasedOnDueDate']     = true;
        $input['UseForeignCurrency'] = true;

        //dd($input);

        $results = Api::apiCall('CustomerAgeing/GetDetail', 0, config('sageoneapi.max_results'), $this->company, $input);

        $totalResults = $results->TotalResults;
//            dd($totalResults);

        Utils::decho("TotalResults: " . $totalResults);

        $apiCommand = ApiCommand::where('command', 'CustomerAgeing/GetDetail')->first();
        // TODO Add company ID above

        if ($apiCommand->last_total_results <> $totalResults) {

            $api_params = new ApiJob();
            $api_params->api_command = $apiCommand->command;
            $api_params->total_results = $totalResults;
            $api_params->skip = $apiCommand->last_total_results;
            $api_params->top = config('sageoneapi.max_results');
            $api_params->company_id = $this->company->id;
            $api_params->status = 'unprocessed';
            $api_params->save();

            dispatch(new RetrieveApiData($apiCommand, $this->company, $input));

        }

        //CustomerAgeing::import($this->company, $response);

        $customerageing = CustomerAgeing::current($this->company->id)->orderBy('id', 'desc')->get();

        //dd($customerageing);

        return view('customerageing.index', compact('customerageing'));

    }

}
