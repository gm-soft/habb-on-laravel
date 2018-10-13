<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 7:52 PM
 */

namespace App\Helpers;


abstract class HtmlHelpers
{
    public static function getStylesForBannerSlider($model){
        $style = "";

        for ($index = 0; $index < $model->banners_count; $index++)
        {
            $style .= ".habb-slider-block-".$index." { background: url(".url($model->banners[$index]->image_path).") no-repeat center; } \r\n";
        }
        return $style;
    }
}