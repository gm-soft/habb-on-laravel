<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/6/18
 * Time: 4:30 PM
 */

namespace App\ViewModels\Front;


use App\Models\Post;

class ShowPostViewModel
{
    /**
     * @var Post
     */
    public $post;

    /**
     * @var Post[]
     */
    public $topPosts;

    /**
     * @var bool
     */
    public $hasAnotherPosts;
}