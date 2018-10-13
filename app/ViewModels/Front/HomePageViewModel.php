<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/6/18
 * Time: 3:37 PM
 */

namespace App\ViewModels\Front;


use App\Models\Banner;
use App\Models\Post;
use App\Traits\FrontDataTrait;

class HomePageViewModel
{
    use FrontDataTrait;

    /**
     * @var int
     */
    public $topPostCount = 3;

    /**
     * @var array|Post[]
     */
    public $posts;

    /** @var Banner[] */
    public $banners;

    /** @var int */
    public $banners_count;
}