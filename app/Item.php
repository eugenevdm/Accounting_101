<?php

namespace App;

use App\Sage\SageoneApi;
use App\Sageone\Api;

class Item extends CompanyBaseModel
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo('App\ItemCategory', 'CategoryId');
    }

    public function invoice_items() {
        return $this->hasMany('App\InvoiceItem', 'SelectionId');
    }

    public static function import($company)
    {

        Item::current($company->id)->delete();

        $response = Api::apiCall("Item/Get",$company);

        if ($response['status'] == 'error') {

            return $response;

        } else {

            foreach ($response['results']->Results as $item) {
                $newItem = new Item();
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

            return [
                'status'  => 'success',
                'results' => count($response['results']->Results) . ' records imported.'
            ];

        }

    }

}
