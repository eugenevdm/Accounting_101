<?php

namespace App;

class PurchaseOrderItem extends CompanyBaseModel
{

    protected $guarded = [];

    public static function import($invoice_id, $line_items, $company_id)
    {
        foreach ($line_items as $item) {
            $newItem = new self();
            $item->invoice_id = $invoice_id;
            $item->company_id = $company_id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }
}
