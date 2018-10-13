<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 6:48 PM
 */

namespace App\ViewModels\Front;


use App\Models\Tournament;

class TournamentsViewModel
{
    /** @var Tournament[] */
    public $tournaments;

    /** @var int */
    public $tournaments_count;
}