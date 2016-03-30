<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends CompanyBaseModel
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\CustomerCategory', 'CategoryId');
    }

    public function getNomAttribute() {
        return $this->Name;
    }

    public static function import($company)
    {

        Customer::current($company->id)->delete();

        $response = Api::apiCall("Customer/Get",$company);

        //dd($response);

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
        //dd($results);
        foreach ($results->Results as $item) {
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
