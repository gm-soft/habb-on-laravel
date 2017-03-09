<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 09.03.2017
 * Time: 19:06
 */

namespace App\Interfaces;


interface IScoreInstance
{
    static function getScoreSet($games = null);
}