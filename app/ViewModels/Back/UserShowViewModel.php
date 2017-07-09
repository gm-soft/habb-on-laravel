<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 09.07.2017
 * Time: 15:42
 */

namespace App\ViewModels\Back;


use App\Models\Gamer;
use App\User;

class UserShowViewModel
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var Gamer
     */
    public $gamer;
}