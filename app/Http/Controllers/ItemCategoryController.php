<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerCategory;
use App\Http\Requests;
use App\ItemCategory;
use App\Sage\SageoneApi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ItemCategoryController extends Controller
{

    public function index() {
        $categories = ItemCategory::where('company_id',$this->company->id)->paginate(100);
        //dd($categories);
        return view('itemcategory.index', compact('categories'));
    }

}
