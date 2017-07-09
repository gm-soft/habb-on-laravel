<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 01.03.2017
 * Time: 21:47
 */

namespace App\Helpers;


abstract class Constants
{
    const FlashLayout    = "shared/flash";
    const ValidationLayout    = "shared/validation";


    const GamesString = "cs:go,dota,hearthstone";
    const CsGo = "cs:go";
    const Dota = "dota";
    const HearthStone = "hearthstone";

    const Success = "success";
    const Error = "danger";
    const Info = "info";
    const Warning = "warning";

    const NotFoundSmile = '¯\_(ツ)_/¯';

    const EmailRegexPattern = '^([A-Za-z0-9_\.-]+)@([A-Za-z0-9_\.-]+)\.([a-z\.]{2,10})$';
    const PhoneRegexPattern = '^(8)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7}$';
    const VkPageRegexPattern = '^(https:\/\/)?(vk\.com)([\/\w \.-]{1,50})*\/?$';

    public static function getCities() {
        $cityString = 'Алматы,Астана,Шымкент,Караганда,Актобе,Тараз,Павлодар,Усть-Каменогорск,Семей,Уральск,Костанай,Кызылорда,Атырау,Петропавлоск,Актау,Темиртау,Туркестан,Кокшетау,Талдыкорган,Экибастуз,Рудный,Жанаозен';
        $cities = explode(",", $cityString);
        return $cities;
    }

    public static function getGameArray(){
        $array = explode(",", self::GamesString);
        return $array;
    }

    /**
     * Возвращает хэш-массив для складывания в селект
     * @param bool $withEmpty
     * @return array
     */
    public static function getGamesForSelect($withEmpty = false) {
        $games = self::getGameArray();
        $result = [];
        if ($withEmpty) $result[''] = 'Без дисциплины';

        foreach ($games as $game) {
            $result[$game] = $game;
        }
        return $result;
    }


}