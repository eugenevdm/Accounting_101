<?php

namespace App\Sageone;

use App\ApiCommand;
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

    public static function getTotalResults(ApiCommand $apiCommand, Company $company)
    {

        Utils::decho("getTotalResults API call '{$apiCommand->command}' company #{$company->id} [{$company->Name}]...");

        $url = config('sageoneapi.api_url')
            . config('sageoneapi.api_version')
            . '/' . $apiCommand->command
            . "?\$skip=0&\$top=1"
            . "&apikey={$company->api_key}&CompanyId={$company->id}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "{$company->username}:{$company->password}");
        $curl_response = curl_exec($ch);
        curl_close($ch);

        //dd($curl_response);

        if ($curl_response === false) {
            $result['status']  = 'error';
            $result['results'] = 'Curl error: ' . curl_error($ch);
            return $result;
        } else {
            $response = json_decode($curl_response);
        }

        if (!isset($response->Results)) {
            $result['status']  = 'error';
            $result['results'] = $curl_response;
            return $result;
        }

        return $response->TotalResults;

    }

    public static function apiCallQueue($command, $skip, $top, Company $company)
    {

        if ($company) {
            Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            $username = $company->username;
            $password = $company->password;
            $api_key  = $company->api_key;
        } else {
            Utils::decho("Doing API call '$command'...");
            $username = Setting::username();
            $password = Setting::password();
            $api_key  = Setting::api_key();
        }

        strpos($command, '?') === false ? $delimiter = "?" : $delimiter = "&";

        $api_url     = 'https://accounting.sageone.co.za/api/';
        $api_version = '1.1.1';

        $url = $api_url . $api_version . '/' . $command . $delimiter . "\$skip=" . $skip . "&\$top=" . $top . "&apikey=$api_key";
        if ($company) {
            $url = $url . "&CompanyId={$company->id}";
        }

        Utils::decho("The API url is " . $url);

        $ch = curl_init();
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
            return $result;
        }

        $result['status']  = 'success';
        $result['results'] = $data;

        curl_close($ch);

        return $result;

    }

    public static function apiCall2($command, Company $company = null, $post = "")
    {

        if ($company) {
            Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            $username = $company->username;
            $password = $company->password;
            $api_key  = $company->api_key;
        } else {
            Utils::decho("Doing API call '$command'...");
            $username = Setting::username();
            $password = Setting::password();
            $api_key  = Setting::api_key();
        }

        strpos($command, '?') === false ? $delimiter = "?" : $delimiter = "&";

        $url = config('sageoneapi.api_url') . config('sageoneapi.api_version') . '/' . $command . $delimiter . "apikey=$api_key";

        if ($company) {
            $url = $url . "&CompanyId={$company->id}";
        }

        //dd($url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        if ($post != "") {
            $post = json_encode($post);
            //dd($post);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($post))
            );
        }

        $response = curl_exec($ch);

        //dd(json_decode($response));

        if ($response === false) {
            $result['status']  = 'error';
            $result['results'] = 'Curl error: ' . curl_error($ch);
            return $result;
        } else {
            $data = json_decode($response);
        }

        //dd($data);

        if (!isset($data->Results)) {
            $result['status']  = 'error';
            $result['results'] = $response;
            return $result;
        }

        //dd($data);

        $result['status']  = 'success';
        $result['results'] = $data;

        curl_close($ch);

        return $result;

    }

    public static function apiCall($command, Company $company = null, $param = false)
    {

        if ($company) {
            Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            $username = $company->username;
            $password = $company->password;
            $api_key  = $company->api_key;
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

        $ch = curl_init();
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

        //dd($data);

        if (!isset($data->Results)) {
            $result['status']  = 'error';
            $result['results'] = $response;
            return $result;
        }

        //dd($data);

        $result['status']  = 'success';
        $result['results'] = $data;

        curl_close($ch);

        return $result;

    }

    /**
     *
     * Post an API command
     *
     * Used by: trial balance and customer ageing
     *
     * TODO Needs refactoring as too many optional parameters and return codes dubious depending on who called
     *
     * @param $command
     * @param Company|null $company
     * @param $post
     * @param bool $param
     * @param bool $suppress
     * @return mixed
     */
    public static function post($command, Company $company = null, $post, $param = false, $suppress = false)
    {

        $data_string = json_encode($post);

        //dd($data_string);

        if ($company) {
            if (!$suppress) {
                Utils::decho("Doing API call '$command' on company '{$company->Name}' ('{$company->id}')...");
            }
            $username = $company->username;
            $password = $company->password;
            $api_key  = $company->api_key;
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

        dd($data_string);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $response = curl_exec($ch);

        //dd($response);

        if ($response === false) {
            $result['status']  = 'error';
            $result['results'] = 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return $result;
        } else {
            $data = json_decode($response);
        }

        //dd($data);

        if (is_array($data)) { // At this point it's probably the trial balance as customer ageing returns an object
            $result['status']  = 'success';
            $result['results'] = $data;
            curl_close($ch);
            return $result;
        }

        curl_close($ch);
        return $data;

    }

}