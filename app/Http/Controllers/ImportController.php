<?php

namespace App\Http\Controllers;

use App\Item;
use App\Account;
use App\Company;
use App\Invoice;
use App\Customer;
use App\AnalysisType;
use App\ItemCategory;
use App\Http\Requests;
use App\AccountCategory;
use App\AnalysisCategory;
use App\CustomerCategory;

class ImportController extends Controller
{

    public function import($module)
    {

        switch ($module) {
            case 'accounts' :
                $result = Account::import($this->company->id);
                break;
            case 'accountcategories' :
                $result = AccountCategory::import($this->company->id);
                break;
            case 'analysiscategories' :
                $result = AnalysisCategory::import($this->company->id);
                break;
            case 'analysistypes' :
                $result = AnalysisType::import($this->company->id);
                break;
            case 'companies' :
                $result = Company::import();
                break;
            case 'customers' :
                $result = Customer::import($this->company->id);
                break;
            case 'customercategories' :
                $result = CustomerCategory::import($this->company->id);
                break;
            case 'items' :
                $result = Item::import($this->company->id);
                break;
            case 'itemcategories' :
                $result = ItemCategory::import($this->company->id);
                break;
            case 'taxinvoices' :
                $result = Invoice::import($this->company->id);
                break;
            default :
                $result = "Error: Unknown import module '$module'.'";
                break;
        }

        return $result;
    }

}
