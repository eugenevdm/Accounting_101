<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class CustomerController extends Controller
{

    public function getIndex()
    {
        return view('customer.index2');
    }

    public function anyData()
    {
        return Datatables::of(Customer::query())->make(true);
    }

    public function index() {
        $customers = Customer::where('company_id',$this->company->id)->paginate(100);
        //dd($customers);
        return view('customer.index', compact('customers'));
    }

}
