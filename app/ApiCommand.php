<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiCommand extends Model
{

    protected $fillable = [
        'company_id',
        'command',
        'model',
        'cron_include',
        'cron_order',
        'description'
    ];

}
