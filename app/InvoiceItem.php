<?php

namespace App;

class InvoiceItem extends CompanyBaseModel
{

    protected $guarded = [];

    public function item() {
        return $this->belongsTo('App\Item','SelectionId');
    }

    public function analysiscategory1() {
        return $this->belongsTo('App\AnalysisCategory','AnalysisCategoryId1');
    }

    public function analysiscategory2() {
        return $this->belongsTo('App\AnalysisCategory','AnalysisCategoryId2');
    }

    public function analysiscategory3() {
        return $this->belongsTo('App\AnalysisCategory','AnalysisCategoryId3');
    }

    public function invoice() {
        return $this->belongsTo('App\Invoice','invoice_id');
    }

    public static function import($invoice_id, $line_items, $company_id)
    {

        foreach ($line_items as $item) {
            $newItem = new InvoiceItem();
            $item->invoice_id = $invoice_id;
            $item->company_id = $company_id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }
}
