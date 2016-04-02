<?php

namespace App\Http\Controllers;

use App\Sageone\Api;
use App\Http\Requests;
use App\CustomerAgeing;
use Illuminate\Support\Facades\Input;

class CustomerAgeingController extends Controller
{

    public function index()
    {
        $customerageing = CustomerAgeing::current($this->company->id)->get();
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

        $response = Api::post('CustomerAgeing/GetDetail', $this->company, $input, null, true);

        CustomerAgeing::import($this->company, $response);

        $customerageing = CustomerAgeing::current($this->company->id)->orderBy('id', 'desc')->get();
        return view('customerageing.index', compact('customerageing'));

    }

}
