<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;

class DashboardController extends Controller
{

    public function show($module)
    {
        $outstanding_balance = Customer::orderBy('Balance','desc')->take(10)->get();
        return view ("dashboard.$module.show", compact('outstanding_balance'));
    }

}
