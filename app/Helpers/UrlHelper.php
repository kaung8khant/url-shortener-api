<?php

namespace App\Helpers;

trait UrlHelper
{
    public static function verifyUrlExists($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (!empty($response) && $response != 404) {

            return true;
        }
        return false;
    }

    public static function generateUniqueSlug()
    {
        do {
            $randomString = strtoupper(substr(str_shuffle(MD5(microtime())), 0, 8));
        } while (is_numeric(substr($randomString, 0, 6)) && substr($randomString, 6, 1) == 'E');

        return $randomString;
    }

}
