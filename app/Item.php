<?php

namespace App;

use App\Sageone\Api;

class Item extends CompanyBaseModel
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\ItemCategory', 'CategoryId');
    }

    public function invoice_items()
    {
        return $this->hasMany('App\InvoiceItem', 'SelectionId');
    }

    public static function import($company)
    {

        Item::current($company->id)->delete();

        $response = Api::apiCall("Item/Get", $company);

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
            $newItem = new Item();
            isset($item->Category) ? $item->CategoryId = $item->Category->ID : $item->CategoryId = null;
            unset($item->Category);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
