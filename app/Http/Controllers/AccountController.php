<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests;

class AccountController extends Controller
{

    public function index() {
        $accounts = Account::where('company_id',$this->company->id)->paginate(100);
        return view('account.index', compact('accounts'));
    }

}
