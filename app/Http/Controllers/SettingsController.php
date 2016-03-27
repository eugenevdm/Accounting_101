<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Setting;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return view('settings.create',compact('settings'));
    }

    public function store() {
        $input = Input::except('_token');
        foreach($input as $k=>$v) {
            $setting = Setting::where('name',$k)->where('group','sageoneaccounting')->first();
            //dd($setting);
            $setting->value = $v;
            $setting->save();
        }
        //dd(Setting::all());
        $settings = Setting::all();

        return Redirect::back()->with('message','Settings updated.');
    }

}
