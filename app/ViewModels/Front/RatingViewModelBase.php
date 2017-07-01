<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 27.06.2017
 * Time: 19:32
 */

namespace App\ViewModels\Front;

/**
 * Class RatingViewModelBase
 * @package app\ViewModels\Front
 */
class RatingViewModelBase
{
    /** @var string Игра */
    public $game;

    /** @var  array Участники ниже порога */
    public $bellow;

    /** @var  array Участники выше порога */
    public $greater;
}
