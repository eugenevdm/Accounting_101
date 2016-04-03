<?php

namespace App;

use App\Sageone\Api;

class Customer extends CompanyBaseModel
{
    protected $guarded = [];

    protected $appends = ['balance'];

    public function category()
    {
        return $this->belongsTo('App\CustomerCategory', 'CategoryId');
    }

    public function getOutstandingAttribute()
    {
        return money_format("%n", $this->Balance);
    }

    public function getNomAttribute()
    {
        return $this->Name;
    }

    public static function import($company)
    {

        Customer::current($company->id)->delete();

        $response = Api::apiCall("Customer/Get", $company);

        if ($response['status'] == 'error') {

            return $response;

        } else {

            self::store($response['results'], $company);

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
