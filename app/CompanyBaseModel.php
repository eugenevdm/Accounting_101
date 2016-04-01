<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBaseModel extends Model {

    protected $guarded = [];

    public function scopeCurrent($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }

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