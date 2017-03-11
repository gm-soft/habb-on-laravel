<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 11.03.2017
 * Time: 14:07
 */

namespace App\Helpers;


abstract class HtmlWrappers
{
    public static function WrapScoreChange($scoreChange){
        $scoreChangeValue = intval($scoreChange);
        $class = $scoreChangeValue >= 0 ? "text-success" : "text-danger";
        $textChanged = $scoreChangeValue >= 0 ? "+".$scoreChange : $scoreChange;
        $result = "<span class='$class'>$textChanged</span>";

        return $result;
    }

    /**
     * Выводит строку-заголовок дивизиона в таблице рейтинга
     * @param string $tdContent Выводимый текст
     * @param int $tdCount Количество выводимых ячеек
     * @param int $contentPos Позиция вывода текста $tdContent в строке
     * @return string
     */
    public static function AddRatingHeaderRow($tdContent, $tdCount = 4, $contentPos = 2){
        $result = "<tr class=\"bg-custom\">";
        for ($i = 1; $i <= $tdCount; $i++){
            $result .= $i == $contentPos ? "<td><b>$tdContent</b></td>" : "<td></td>";
        }
        $result .= "</tr>";
        return $result;
    }

}