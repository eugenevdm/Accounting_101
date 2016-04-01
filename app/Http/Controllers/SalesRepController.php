<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\SalesRep;
use Yajra\Datatables\Datatables;

class SalesRepController extends Controller
{

    public function index() {
        $salesreps = SalesRep::paginate(25);
        return view('salesrep.index', compact('salesreps'));
    }

}
