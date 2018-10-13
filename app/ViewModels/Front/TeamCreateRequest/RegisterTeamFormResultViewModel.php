<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:48 PM
 */

namespace App\ViewModels\Front\TeamCreateRequest;


use App\Models\TeamCreateRequest;
use App\Traits\FrontDataTrait;

class RegisterTeamFormResultViewModel
{
    use FrontDataTrait;

    /** @var TeamCreateRequest */
    public $team_request;

}