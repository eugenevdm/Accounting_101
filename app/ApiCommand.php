<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiCommand extends Model
{

    protected $fillable = [
        'command',
        'company_id',
        'cron_include',
        'cron_order',
        'description',
        'model',
        'url'
    ];

}
