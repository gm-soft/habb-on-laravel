<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 6:21 PM
 */

namespace App\ViewModels\Back\Tournament;


use App\Models\Tournament;
use App\ViewModels\Back\SelectOptionItem;

class TournamentEditViewModel
{
    /** @var Tournament */
    public $tournament;

    /** @var SelectOptionItem[] */
    public $select_options;
}