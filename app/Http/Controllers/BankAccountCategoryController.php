<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\BankAccountCategory;
use App\Http\Requests;

class BankAccountCategoryController extends Controller
{

    public function index() {
        $bankaccountcategories = BankAccountCategory::current($this->company->id)->paginate(25);
        return view('bankaccountcategory.index', compact('bankaccountcategories'));
    }

}
