<?php

namespace App\Http\Controllers;

use App\ApiCommand;
use App\Company;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

/**
 *
 * Due to name clash with global $this->company object we use $c in this controller
 *
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{

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

    public function index() {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    public function edit($id)
    {
        $c = Company::find($id);
        return view('company.edit', compact('c'));
    }

    public function update($id) {
        $input = Input::all();
        Company::find($id)->update($input);
        return Redirect::route('company.index')->with('message', 'Company updated.');
    }

    public function show($id) {
        $c = Company::find($id);

        $api_commands =  ApiCommand::where('company_id', $c->id)->orderBy('cron_include','desc')->orderBy('cron_order')->get();
        return view('company.show', compact('c', 'api_commands'));
    }

}
