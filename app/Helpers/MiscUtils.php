<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 23.06.18
 * Time: 11:57
 */

namespace App\Helpers;


use Carbon\Carbon;
use Illuminate\Http\Request;

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

    /**
     * @param array $input
     * @param string $key
     * @param mixed|null $defaultValue
     * @return mixed|null
     */
    public static function getValueOrDefault(array $input, $key, $defaultValue = null){
        return isset($input[$key]) ? $input[$key] : $defaultValue;
    }

    /**
     * Удаляет специсимволы из телефона
     * @param $phone
     * @return mixed
     */
    public static function formatPhone($phone) {
        $phone = str_replace('+7','8',$phone);
        $phone = str_replace('-', '',$phone);
        $phone = str_replace('(', '',$phone);
        $phone = str_replace(')', '',$phone);
        $phone = str_replace(' ', '', $phone);

        // Если телефон начинается с семерки, а не с восьмерки 77019997733
        if (self::startsWith($phone, "7") && strlen($phone) === 11){
            $phone = "8".substr($phone, 1);
        }
        return $phone;
    }

    /**
     * @param string $source Строка, в которой будет осуществлен поиск
     * @param string $query Искомое значение
     * @return bool
     */
    public static function startsWith($source, $query){
        return substr($source, 0, strlen($query)) === $query;
    }

    /**
     * @param $needle
     * @param $haystack
     * @return bool
     */
    public static function search_array($needle, $haystack) {

        if(in_array($needle, $haystack)) {
            return true;
        }

        foreach($haystack as $element) {
            if(is_array($element) && self::search_array($needle, $element))
                return true;
        }
        return false;
    }


    const AlmatyLocalTimezone = 'Asia/Almaty';

    /**
     * @param string $value
     * @return Carbon
     */
    public static function parseLocalDatetime($value) {
        $date = Carbon::parse($value, self::AlmatyLocalTimezone)->setTimezone('UTC');
        return $date;
    }

    /**
     * @return Carbon
     */
    public static function getLocalDatetimeNow(){
        $date = Carbon::now(self::AlmatyLocalTimezone)->setTimezone('UTC');
        return $date;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public static function isIosDevice(Request $request){
        $userAgent = $request->header('User-Agent');
        return stripos($userAgent,"iPod")||
            stripos($userAgent,"iPhone") ||
            stripos($userAgent,"iPad");
    }
}