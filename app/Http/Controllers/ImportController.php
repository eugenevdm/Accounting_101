<?php

namespace App\Http\Controllers;

use App\ApiParams;
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
use App\Jobs\RetrieveApiData;
use App\Sageone\Api;
use App\Snowball\Utils;

class ImportController extends Controller
{

    public function import($module)
    {

        switch ($module) {
            case 'accounts' :
                //Account::current($company->id)->delete();
                $api_command = "Item/Get";
                $response = Api::apiCall($api_command, $this->company);
                //dd($response);
                if ($response['status'] == 'error') {
                    return $response;
                }

                $results = $response['results'];
                Utils::ddecho("Total Results: " . $results->TotalResults);
                Utils::ddecho("Returned Results: " . $results->ReturnedResults);

                // Store data
                Item::store($results, $this->company);

                if ($results->TotalResults > $results->ReturnedResults) {
                    $api_params = new ApiParams();
                    $api_params->api_command = $api_command;
                    $api_params->total_results = $results->TotalResults;
                    $api_params->skip = 100;
                    $api_params->top = 100;
                    $api_params->company_id = $this->company->id;
                    $api_params->status = 'unprocessed';
                    $api_params->save();
                    $this->dispatch(new RetrieveApiData($api_command, $this->company));
                }
                $result = "Queued";
                break;
            case 'accounts2' :
                $result = Account::import($this->company);
                break;
            case 'accountcategories' :
                $result = AccountCategory::import($this->company);
                break;
            case 'analysiscategories' :
                $result = AnalysisCategory::import($this->company);
                break;
            case 'analysistypes' :
                $result = AnalysisType::import($this->company);
                break;
            case 'companies' :
                $result = Company::import();
                break;
            case 'customers' :
                $result = Customer::import($this->company);
                break;
            case 'customercategories' :
                $result = CustomerCategory::import($this->company);
                break;
            case 'items' :
                $result = Item::import($this->company);
                break;
            case 'itemcategories' :
                $result = ItemCategory::import($this->company);
                break;
            case 'taxinvoices' :
                $result = Invoice::import($this->company);
                break;
            default :
                $result = "Error: Unknown import module '$module'.'";
                break;
        }

        return $result;
    }

}
