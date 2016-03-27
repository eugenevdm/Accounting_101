<?php

namespace App\Http\Controllers;

use App\AnalysisCategory;
use App\Http\Requests;

class AnalysisCodeController extends Controller
{

    public function index() {
        $analysiscategories = AnalysisCategory::where('company_id',$this->company->id)->paginate(100);
        return view('analysiscode.index', compact('analysiscategories'));
    }

}
