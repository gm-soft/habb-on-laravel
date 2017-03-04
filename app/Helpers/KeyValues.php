<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 01.03.2017
 * Time: 22:36
 */

namespace App\Helpers;


class KeyValues
{
    /**
     * Возвращает в статике массив вида [key , value]
     *
     * @param string $key
     * @param mixed $value
     * @return array
     */
    public static function Get($key, $value) {
        return [$key => $value];
    }
}