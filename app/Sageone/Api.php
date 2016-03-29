<?php

namespace App\Sageone;

use App\Company;
use App\Setting;
use App\Snowball\Utils;

class Api
{

    public static function getCompanies()
    {
        $command = "Company/Get";
        return self::apiCall($command);
    }

    public static function apiCall($command, Company $company = null, $param = false)
    {

        if ($company) {
            Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            $username = $company->username;
            $password = $company->password;
            $api_key = $company->api_key;
        } else {
            Utils::decho("Doing API call '$command'...");
            $username = Setting::username();
            $password = Setting::password();
            $api_key  = Setting::api_key();
        }

        $param == false ? $delimiter = "?" : $delimiter = "&";

        $api_url     = 'https://accounting.sageone.co.za/api/';
        $api_version = '1.1.1';

        $url = $api_url . $api_version . '/' . $command . $delimiter . "apikey=$api_key";
        if ($company) {
            $url = $url . "&CompanyId={$company->id}";
        }

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        $response = curl_exec($ch);

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

    public static function post($command, Company $company = null, $post, $param = false, $suppress = false)
    {

        $data_string = json_encode($post);

        if ($company) {
            if (!$suppress) {
                Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            }
            $username = $company->username;
            $password = $company->password;
            $api_key = $company->api_key;
        } else {
            if (!$suppress) {
                Utils::decho("Doing API call '$command'...");
            }
            $username = Setting::username();
            $password = Setting::password();
            $api_key  = Setting::api_key();
        }

        $param == false ? $delimiter = "?" : $delimiter = "&";

        $api_url     = 'https://accounting.sageone.co.za/api/';
        $api_version = '1.1.1';

        $url = $api_url . $api_version . '/' . $command . $delimiter . "apikey=$api_key";
        if ($company) {
            $url = $url . "&CompanyId={$company->id}";
        }

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $response = curl_exec($ch);

        //dd($response);

        if ($response === false) {
            $result['status']  = 'error';
            $result['results'] = 'Curl error: ' . curl_error($ch);
            return $result;
        } else {
            $data = json_decode($response);
        }

        if (!is_array($data)) {
            $result['status']  = 'error';
            $result['results'] = $response;
        } else {
            $result['status']  = 'success';
            $result['results'] = $data;
        }

        curl_close($ch);

        //dd($result);

        return $result;

    }

}