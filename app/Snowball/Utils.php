<?php

namespace App\Snowball;

class Utils
{

    public static function decho($message) {
        //date_default_timezone_set("Africa/Johannesburg");
        echo date("Y-m-d H:i:s ") . $message . PHP_EOL;
    }
}

