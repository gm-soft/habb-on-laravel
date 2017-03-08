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
}