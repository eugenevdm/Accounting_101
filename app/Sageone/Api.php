<?php

namespace App\Sageone;

use App\Company;
use App\Setting;
use App\Snowball\Utils;

class Api
{

//    public static function getAccounts(Company $company)
//    {
//        $command = "Account/Get";
//        //echo "Now doing Account/Get for company ID: " . $company_id;
//        return self::doApiCall($command, $company);
//    }
//
//    public static function getAccountCategories($company_id)
//    {
//        $command = "AccountCategory/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getAnalysisCategories($company_id)
//    {
//        $command = "AnalysisCategory/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getAnalysisTypes($company_id)
//    {
//        $command = "AnalysisType/Get";
//        return self::doApiCall($command, $company_id);
//    }

    public static function getCompanies()
    {
        $command = "Company/Get";
        return self::apiCall($command);
    }

//    public static function getCustomers($company_id)
//    {
//        $command = "Customer/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getCustomerCategories($company_id)
//    {
//        $command = "CustomerCategory/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getItems($company_id) {
//        //$command = "GET Item/Get?includeAdditionalItemPrices=false";
//        $command = "Item/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getItemCategories($company_id)
//    {
//        $command = "ItemCategory/Get";
//        return self::doApiCall($command, $company_id);
//    }
//
//    public static function getInvoices($company_id)
//    {
//        $command = "TaxInvoice/Get?includeDetail=true";
//        return self::doApiCall($command, $company_id, true);
//    }

    public static function apiCall($command, Company $company = null, $param = false)
    {

        if ($company) {
            Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
        } else {
            Utils::decho("Doing API call '$command'...");
        }

        $param == false ? $delimiter = "?" : $delimiter = "&";
        //$username    = 'eugene@snowball.co.za';
        $settings = Setting::all();
        //dd($settings);

        //$username    = 'eugenevdm@gmail.com';
        //$password    = 'Acc101$';
        //$api_key     = '{4E908D25-6545-4639-8294-8341C7844E9A}';
        //$api_key     = '{F1C367B0-78A4-4AD3-8951-3ACF263EBAAC}';
        $username = $settings->where('name', 'username')->first()->value;
        $password = $settings->where('name', 'password')->first()->value;
        $api_key  = $settings->where('name', 'api_key')->first()->value;

        //dd($username);

        $api_url     = 'https://accounting.sageone.co.za/api/';
        $api_version = '1.1.1';

        //$url = $api_url . $api_version . '/' . $command . $delimiter . "apikey=$api_key&CompanyId={$company->id}";
        $url = $api_url . $api_version . '/' . $command . $delimiter . "apikey=$api_key";

        //dd($url);

        if ($company) {
            $url = $url . "&CompanyId={$company->id}";
        }

//        dd($password);
//        dd($url);

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

        //dd($response);

        if ($response === false) {
            $result['status']  = 'error';
            $result['results'] = 'Curl error: ' . curl_error($ch);
            return $result;
        } else {
            $data = json_decode($response);
        }

        if (!isset($data->Results)) {
            $result['status']  = 'error';
            $result['results'] = $response;
        } else {
            $result['status']  = 'success';
            $result['results'] = $data;
        }

        curl_close($ch);

        return $result;

    }

}