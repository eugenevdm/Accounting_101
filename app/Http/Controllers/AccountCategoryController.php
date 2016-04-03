<?php

namespace App\Http\Controllers;

use App\AccountCategory;
use App\Http\Requests;

class AccountCategoryController extends Controller
{

    public function index() {
        $accountcategories = AccountCategory::where('company_id',$this->company->id)->paginate(100);
        return view('accountcategory.index', compact('accountcategories'));
    }

}
