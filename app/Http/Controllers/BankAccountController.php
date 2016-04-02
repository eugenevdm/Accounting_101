<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Http\Requests;

class BankAccountController extends Controller
{

    public function index() {
        $bankaccounts = BankAccount::current($this->company->id)->paginate(25);
        return view('bankaccount.index', compact('bankaccounts'));
    }

}
