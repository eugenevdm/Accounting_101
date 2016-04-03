<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportingGroup extends CompanyBaseModel
{
    protected $guarded = [];

    public static function store($results, Company $company)
    {
        foreach ($results as $item) {
            $newItem = new self();
            if (isset($item->AccountCategory)) {
                $item->AccountCategoryId = $item->AccountCategory->ID;
            } else {
                $item->AccountCategoryId = null;
            }
            unset($item->AccountCategory);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }
}
