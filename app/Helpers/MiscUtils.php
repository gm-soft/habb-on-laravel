<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 11:57
 */

namespace App\Helpers;


abstract class MiscUtils
{
    /**
     * Генерит рандомную строку
     * https://stackoverflow.com/a/4356295
     * @param int $length
     * @return string
     */
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * генерит закодированную SHA1 строку
     * @param int $length
     * @return string
     */
    public static function generateSha1RandomString($length = 10){
        return sha1(self::generateRandomString($length));
    }
}