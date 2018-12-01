<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11/28/18
 * Time: 8:18 PM
 */

namespace App\ViewModels\Front\RegisterForm;


use App\Models\Tournament;
use App\Traits\FrontDataTrait;

class EventRegistrationResultViewModel
{
    use FrontDataTrait;

    /** @var Tournament $tournament */
    public $tournament;

    /** @var string */
    public $linkToShare;
}