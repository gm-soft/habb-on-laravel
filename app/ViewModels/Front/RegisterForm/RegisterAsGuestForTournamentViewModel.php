<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11/28/18
 * Time: 12:08 AM
 */

namespace App\ViewModels\Front\RegisterForm;


use App\Helpers\Constants;
use App\Traits\FrontDataTrait;

class RegisterAsGuestForTournamentViewModel
{
    use FrontDataTrait;

    public $tournamentId;

    public $tournamentName;

    /** @var bool */
    public $isIosDevice;

    /** @var string */
    public $emailPattern = Constants::EmailRegexPattern;

}