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

        DB::table('companies')->truncate();

        $items = Api::getCompanies();

        //dd($items);

        foreach ($items['results']->Results as $item) {
            $newItem = new Company();
            $newItem->fill((array)$item);
            $newItem->save();
        }

        $company = Company::first();
        $company->selected = true;
        $company->save();

    }

}
