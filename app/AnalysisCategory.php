<?php

namespace App;

use App\Sageone\Api;

class AnalysisCategory extends CompanyBaseModel
{

    protected $guarded = [];

    public function type() {
        return $this->belongsTo('App\AnalysisType', 'AnalysisTypeId');
    }

    public static function import($company)
    {

        AnalysisCategory::current($company->id)->delete();

        $response = Api::apiCall("AnalysisCategory/Get",$company);

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
