<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:52 PM
 */

namespace App\ViewModels\Front\Auth;


use App\Traits\FrontDataTrait;

class ProfileFormViewModel
{
    use FrontDataTrait;

    public $current_user;
}