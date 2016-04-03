<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ReportingGroup;

class AccountReportingGroupController extends Controller
{

    public function index() {
        $reportinggroups = ReportingGroup::current($this->company->id)->paginate(100);
        return view('accountreportinggroup.index', compact('reportinggroups'));
    }

}
