<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesRep extends Model
{

    protected $guarded = [];

    public static function store($results, Company $company)
    {
        foreach ($results->Results as $item) {
            $newItem = new self();
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
