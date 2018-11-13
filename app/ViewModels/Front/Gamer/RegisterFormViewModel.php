<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:34 PM
 */

namespace App\ViewModels\Front\Gamer;


use App\Traits\FrontDataTrait;

class RegisterFormViewModel
{
    use FrontDataTrait;

    /** @var boolean */
    public $isAppleDevice;

    /** @var string[] */
    public $cities;

}