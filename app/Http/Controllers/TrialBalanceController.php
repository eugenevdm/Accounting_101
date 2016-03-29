<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Sageone\Api;
use App\TrialBalance;
use Illuminate\Support\Facades\Input;

class TrialBalanceController extends Controller
{

    public function index()
    {
        $trialbalance = TrialBalance::current($this->company->id)->orderBy('id', 'desc')->get();
        $fromDate = config('reports.trialbalancefromdate');
        $toDate = config('reports.trialbalancetodate');
        return view('trialbalance.index', compact('trialbalance','fromDate','toDate'));
    }

    public function choose() {
        return view('trialbalance.choose');
    }

    /**
     * Execute the Trial Balance using the chosen parameters
     *
     * Example date range: Date Range:    01/03/2016  to  28/02/2017
     */
    public function store()
    {
        $input = Input::all();
        //var_dump($input);
        //dd($input);
        if ($input['Comparative'] == "1") $input['Comparative'] = true;
//        echo "<pre>";
//        var_dump($input);
//        echo "</pre>";

        $fromDate = $input['FromDate'];
        $toDate   = $input['ToDate'];

        config(['reports.trialbalancefromdate' => $fromDate]);
        config(['reports.trialbalancetodate' => $toDate]);

        $post = [
            'FromDate'     => $input['FromDate'],
            'ToDate'       => $input['ToDate'],
            'ShowMovement' => $input['ShowMovement'],
            'Comparative'  => $input['Comparative'],
            'CurrencyId'   => 1
        ];

        $response = Api::post('TrialBalance/Export', $this->company, $post, null, true);

        //dd($response);

        TrialBalance::import($this->company, $response);

        $trialbalance = TrialBalance::current($this->company->id)->orderBy('id', 'desc')->get();

        return view('trialbalance.index', compact('trialbalance','fromDate','toDate'));

    }

}
