<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $company;

    public function __construct()
    {
        $this->middleware('auth');

        $this->company = Company::where('selected',1)->first();

    }
}
