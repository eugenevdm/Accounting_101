<?php

namespace App;

class CustomerAgeing extends CompanyBaseModel
{

    protected $table="customer_ageing";

    public function customer() {
        return $this->hasOne('\App\Customer','ID','CustomerId');
    }

    public static function import(Company $company, $response)
    {

        CustomerAgeing::current($company->id)->delete();

        //dd($response);

        foreach ($response->Results as $item) {
            $newItem          = new self();

            if (isset($item->Customer)) {
                $item->CustomerId = $item->Customer->ID;
            } else {
                $item->CustomerId = null;
            }
            unset($item->Customer);

            unset($item->AgeingTransactions);

            $item->company_id = $company->id;
            $newItem->fill((array)$item);
            $newItem->save();
        }
    }

}
