<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ClearUrl
{
    public static function clear(string $url): string
    {
        if (Str::endsWith($url, '/')) {
            $url = substr($url,0,strlen($url)-1);
        }

        return $url;
    }
}
