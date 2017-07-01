<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 27.06.2017
 * Time: 19:39
 */

namespace App\ViewModels\Front;

/**
 * Class TeamRatingViewModel
 * @package app\ViewModels\Front
 */
class TeamRatingViewModel extends RatingViewModelBase
{
    /** @var  array Массив игроков в составе команды */
    public $gamers;
}