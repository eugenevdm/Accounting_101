<?php

namespace App;

use App\Sage\SageoneApi;
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

            foreach ($response['results']->Results as $item) {
                $newItem = new AnalysisCategory();
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
