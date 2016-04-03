<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;

class Account extends CompanyBaseModel
{

    protected $guarded = [];

    public function getCurrentBalanceAttribute()
    {
        return money_format("%n", $this->Balance);
    }

    public function category()
    {
        return $this->belongsTo('App\AccountCategory', 'CategoryId');
    }

    public static function import(Company $company)
    {

        Account::current($company->id)->delete();

        $response = Api::apiCall("Account/Get",$company);

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
        foreach ($results as $item) {
            $newItem = new self();
            if (isset($item->Category)) {
                $item->CategoryId = $item->Category->ID;
            } else {
                $item->CategoryId = null;
            }
            unset($item->Category);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
