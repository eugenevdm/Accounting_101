<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;

class AnalysisType extends CompanyBaseModel
{

    protected $guarded = [];

    public static function import($company)
    {

        AnalysisType::current($company->id)->delete();

        $response = Api::apiCall("AnalysisType/Get",$company);

        //dd($response);

        if ($response['status'] == 'error') {

            return $response;

        } else {

            foreach ($response['results']->Results as $item) {
                $newItem = new AnalysisType();
                unset($item->AnalysisCategories);
                $item->company_id = $company->id;
                $newItem->fill((array)$item);
                $newItem->save();
            }

            return [
                'status'  => 'success',
                'results' => count($response['results']->Results) . ' records imported.'
            ];

        }

    }

}
