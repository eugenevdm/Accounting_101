<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{

    public function index() {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function edit($id)
    {
        $c = Company::find($id);
        //dd($id);
        //dd($company);
        return view('company.edit', compact('c'));
    }

    public function update($id) {
        $input = Input::all();
        Company::find($id)->update($input);
        return Redirect::route('company.index')->with('message', 'Company sync updated.');
    }

    public function select($id) {
        DB::beginTransaction();
        // Deselect old company
        if (is_object($this->company)) {
            $this->company->selected=false;
            $this->company->save();
        }
        // Select new company
        $company = Company::find($id);
        $company->selected = true;
        $company->save();
        DB::commit();
        // Assign global method variable
        $this->company = $company;
        return Redirect::back()->with('message',"Company '" . $company->Name . "' selected.");
    }

}
