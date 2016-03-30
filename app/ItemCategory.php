<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends CompanyBaseModel
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany('App\Item', 'ID');
    }

    public static function import(Company $company)
    {

        ItemCategory::current($company->id)->delete();

        $response = Api::apiCall("ItemCategory/Get",$company);

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
            unset($item->AnalysisCategories);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
