<?php

namespace App;

use App\Sageone\Api;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public static function import()
    {

        $items = Api::getCompanies();

        foreach ($items['results']->Results as $item) {
            // Decaseify id as having in uppercase doesn't work on the model save() method
            $item->id = $item->ID;
            unset($item->ID);
            // Add the currently logged in user's credentials as these worked
            $item->username = Setting::username();
            $item->password = Setting::password();
            $item->api_key = Setting::api_key();
            Company::updateOrCreate(['id'=>$item->id], (array)$item);
        }

        $company = Company::first();
        $company->selected = true;
        $company->save();

    }

}
