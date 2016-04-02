<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ApiSettingsController extends Controller
{

    public function index()
    {
        $apisettings = Setting::all();
        return view('apisettings.create',compact('apisettings'));
    }

    public function store() {

        $input = Input::except('_token');

        foreach($input as $k=>$v) {
            $apisetting = Setting::where('name',$k)->where('group','sageoneaccounting')->first();
            $apisetting->value = $v;
            $apisetting->save();
        }

        return Redirect::back()->with('message','API settings updated.');
    }

}
