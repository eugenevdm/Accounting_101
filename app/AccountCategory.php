<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;

class AccountCategory extends CompanyBaseModel
{
    protected $guarded = [];

    public static function import(Company $company)
    {

        AccountCategory::current($company->id)->delete();

        $response = Api::apiCall("AccountCategory/Get",$company);

        if ($response['status'] == 'error') {

            return $response;

        } else {

            self::store($response['results']->Results, $company);

            return [
                'status'  => 'success',
                'results' => count($response['results']->Results) . ' records imported.'
            ];

        }

    }

    public static function store($results, Company $company)
    {
        foreach ($results->Results as $item) {
            $newItem = new self();
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
