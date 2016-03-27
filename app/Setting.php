<?php

// Possible API keys
//
// {4E908D25-6545-4639-8294-8341C7844E9A}
// {F1C367B0-78A4-4AD3-8951-3ACF263EBAAC}

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    public static function api_url()
    {
        return self::where('name', 'api_url')->first()->value;
    }

    public static function api_version()
    {
        return self::where('name', 'api_version')->first()->value;
    }

    public static function api_key()
    {
        return self::where('name', 'api_key')->first()->value;
    }

    public static function username()
    {
        return self::where('name', 'username')->first()->value;
    }

    public static function password()
    {
        return self::where('name', 'password')->first()->value;
    }

}
