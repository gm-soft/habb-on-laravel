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
    const BackLayoutPath    = "admin/shared/layout";
    const BackNavPath       = "admin/shared/nav";
    const FlashLayout    = "shared/flash";
    const ValidationLayout    = "shared/validation";

    const FrontLayoutPath   = "front/shared/layout";
    const FrontNavPath      = "front/shared/nav";

    const GamesString = "cs:go,dota,hearthstone";
    const CsGo = "cs:go";
    const Dota = "dota";
    const HearthStone = "hearthstone";

    const Success = "success";
    const Error = "danger";
    const Info = "info";
    const Warning = "warning";

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


}