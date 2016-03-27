<?php

namespace App\Snowball;

class Utils
{
    public static function decho($message) {
        echo date("Y-m-d H:i:s ") . $message . PHP_EOL;
    }
}
