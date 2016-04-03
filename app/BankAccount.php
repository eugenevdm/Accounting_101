<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends CompanyBaseModel
{

    protected $guarded = [];

    public static function store($results, Company $company)
    {
        foreach ($results as $item) {
            $newItem = new self();
            if (isset($item->Category)) {
                $item->CategoryId = $item->Category->ID;
            } else {
                $item->CategoryId = null;
            }
            unset($item->Category);
            if (isset($item->BankFeedAccount)) {
                $item->BankFeedAccountId = $item->BankFeedAccount->ID;
            } else {
                $item->BankFeedAccountId = null;
            }
            unset($item->BankFeedAccount);
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }

    }

}
