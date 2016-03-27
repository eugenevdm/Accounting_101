<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerCategory;
use App\Http\Requests;
use App\Sage\SageoneApi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CustomerCategoryController extends Controller
{

    public function index() {
        $categories = CustomerCategory::where('company_id',$this->company->id)->paginate(100);
        //dd($categories);
        return view('customercategory.index', compact('categories'));
    }

}
