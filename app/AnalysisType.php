<?php

namespace App;

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
            unset($item->AnalysisCategories);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
