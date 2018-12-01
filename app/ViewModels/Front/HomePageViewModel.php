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

    const TopPostCount = 3;

    /**
     * @var array|Post[]
     */
    public $posts;

    /** @var int */
    public $post_count;

    /** @var Banner[] */
    public $banners;

    /** @var int */
    public $banners_count;
}