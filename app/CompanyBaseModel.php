<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyBaseModel extends Model {

    protected $guarded = [];

    public function scopeCurrent($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }

}