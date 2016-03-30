<?php

namespace App;

use App\Sageone\Api;
use Illuminate\Support\Facades\DB;

class Invoice extends CompanyBaseModel
{

    protected $guarded = [];

    public function customer() {
        return $this->belongsTo('App\Customer', 'CustomerId');
    }

    public function lineitems() {
        return $this->hasMany('App\InvoiceItem', 'invoice_id', 'ID');
    }

    public static function import($company)
    {

        DB::table('invoices')->where('company_id', '=', $company->id)->delete();
        DB::table('invoice_items')->where('company_id', '=', $company->id)->delete();

        $response = Api::apiCall("TaxInvoice/Get?includeDetail=true", $company, true);

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
        foreach ($results->Results as $item) {
            $newItem = new Invoice();
            unset($item->SalesRepresentative);
            InvoiceItem::import($item->ID, $item->Lines, $company->id);
            unset($item->Lines);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
