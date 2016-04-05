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
//        $customers = Customer::current($this->company->id)->paginate(100);
        $customers = Customer::current($this->company->id)->paginate(5000);
        return view('customer.index', compact('customers'));
    }

}
