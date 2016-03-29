<?php

namespace App;

class TrialBalance extends CompanyBaseModel
{
    protected $guarded = [];

    public function accounttype() {
        return $this->belongsTo('\App\AccountType', 'AccountTypeId');
    }

    public function account() {
        return $this->belongsTo('\App\Account', 'AccountId');
    }

//    public function deb() {
//        setlocale(LC_MONETARY,"en_US");
////        money_format("%.2n", $item->deb)
//        return money_format("%i", $this->Debit);
//    }

    public static function import(Company $company, $response)
    {

        TrialBalance::current($company->id)->delete();

        //dd($response);

        foreach ($response['results'] as $item) {
            $newItem          = new TrialBalance();
            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }
    }
}
