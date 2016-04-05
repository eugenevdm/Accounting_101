<?php

namespace App\Http\Controllers;

use App\ApiCommand;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Redirect;

class ApiCommandController extends Controller
{

    public function index() {
        $apicommands = ApiCommand::get();
        return view('apicommand.index',compact('apicommands'));
    }

    public function edit($id) {
        $apicommand = ApiCommand::find($id);
        return view('apicommand.edit',compact('apicommand'));
    }

    public function create() {
        return view('apicommand.create');
    }

    public function store() {
        $input = Input::all();
        $result = ApiCommand::create($input);
        dd($result);
    }

    public function update($id)
    {
        $input = Input::all();
        ApiCommand::find($id)->update($input);
        return Redirect::route('apicommand.index')->with('message', 'API Command updated.');
    }

}
