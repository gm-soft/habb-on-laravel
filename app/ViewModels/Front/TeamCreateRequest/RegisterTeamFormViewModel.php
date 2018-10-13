<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:45 PM
 */

namespace App\ViewModels\Front\TeamCreateRequest;


use App\Traits\FrontDataTrait;

class RegisterTeamFormViewModel
{
    use FrontDataTrait;

    /** @var string[] */
    public $cities;

    /** @var string */
    public $emailPattern;
}