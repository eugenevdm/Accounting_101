<?php

namespace App\Sageone;

use App\ApiCommand;
use App\Company;
use App\Setting;
use App\Snowball\Utils;

/**
 *
 * The API has these functions:
 *
 * getTotalResults => $response->TotalResults
 * Normal get command => $response->?
 * post - used by TrialBalance and Customer Ageing
 *  TrialBalance just returns some JSON whereas Customer Ageing has similar response to a normal get command
 * getCompanies => return a list of companies - doesn't need companies object
 *
 * Class Api
 * @package App\Sageone
 */
class Api
{

    public static function getCompanies()
    {
        $command = "Company/Get";
        return self::apiCall($command, 0, config('sageoneapi.max_results'));
    }

    public static function apiCall($command, $skip = 0, $top = 1, Company $company = null, $post = "")
    {

        $credentials = self::getCredentials($company, $command);

        strpos($command, '?') === false ? $delimiter = "?" : $delimiter = "&";

        $url = config('sageoneapi.api_url') . config('sageoneapi.api_version')
            . '/' . $command . $delimiter . "\$skip=" . $skip . "&\$top=" . $top . "&apikey={$credentials['api_key']}";

        if ($company) {
            $url .= "&CompanyId={$company->id}";
        }

        Utils::decho("API URL: " . $url);

        $response = self::getCurl($url, $credentials, $post);

        return $response;

    }

    private static function getCurl($url, $credentials, $post = "")
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "{$credentials['username']}:{$credentials['password']}");

        if ($post != "") {
            $post = json_encode($post);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($post)]
            );
        }

        $response = curl_exec($ch);

        if ($response === false) {
            Utils::decho('Curl error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        return json_decode($response);

    }

    private static function getCredentials($company, $command)
    {
        if ($company) {
            $credentials['username'] = $company->username;
            $credentials['password'] = $company->password;
            $credentials['api_key']  = $company->api_key;
            Utils::decho("API command '$command' on company '{$company->Name}' ('{$company->id}')...");
        } else {
            $credentials['username'] = Setting::username();
            $credentials['password'] = Setting::password();
            $credentials['api_key']  = Setting::api_key();
            Utils::decho("API command '$command'...");
        }
        return $credentials;
    }

}