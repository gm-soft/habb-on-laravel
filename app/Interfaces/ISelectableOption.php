<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 08.03.2017
 * Time: 9:24
 */

namespace App\Interfaces;


interface ISelectableOption
{
    public function getIdentifier();

    public function getName();

    /**
     * ВОзвращает массив значений для загрузки в селекты
     * Ключ массива = идентификатор (айди), значение = название/имя
     * @param bool $withEmpty
     * @return array
     */
    public static function getSelectableOptionArray($withEmpty = true);
}