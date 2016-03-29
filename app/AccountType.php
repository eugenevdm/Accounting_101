<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    public function init()
    {

        DB::table('account_types')->truncate();

        $account_types = [
            '1' => 'Account Balance',
            '2' => 'System Account',
            '4' => 'Bank Account Balance'
        ];

        foreach ($account_types as $item) {
            $newItem = new AccountType();
            $newItem->fill($item);
            $newItem->save();
        }

    }
}
