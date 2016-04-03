<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;
use Illuminate\Database\Eloquent\Model;

class CustomerCategory extends CompanyBaseModel
{
    protected $guarded = [];

    public function customers()
    {
        return $this->hasMany('App\Customer', 'ID');
    }

    public static function import(Company $company)
    {

        CustomerCategory::current($company->id)->delete();

        $response = Api::apiCall("CustomerCategory/Get",$company);

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
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
