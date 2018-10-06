<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/6/18
 * Time: 3:37 PM
 */

namespace App\ViewModels\Front;


use App\Models\Post;

class HomePageViewModel
{
    /**
     * @var int
     */
    public $topPostCount = 3;

    /**
     * @var array|Post[]
     */
    public $posts;
}