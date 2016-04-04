<?php

namespace App;

class PurchaseOrder extends CompanyBaseModel
{

    protected $guarded = [];

    public static function store($results, Company $company)
    {
        foreach ($results as $item) {
            $newItem = new self();

            if (isset($item->Supplier)) {
                $item->SupplierId = $item->Supplier->ID;
            } else {
                $item->SupplierId = null;
            }
            unset($item->Supplier);

            PurchaseOrderItem::import($item->ID, $item->Lines, $company->id);
            unset($item->Lines);

            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }
}
