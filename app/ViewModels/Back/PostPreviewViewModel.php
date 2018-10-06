<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/6/18
 * Time: 5:39 PM
 */

namespace App\ViewModels\Back;


use App\Models\Post;

class PostPreviewViewModel
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $imageLink;

    /**
     * @var string
     */
    public $content;

    /**
     * @var Post[]
     */
    public $topPosts;
}