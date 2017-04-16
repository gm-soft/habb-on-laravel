<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 16.04.2017
 * Time: 12:39
 */

namespace App\ViewModels;

use App\Models\Post;

class NewsViewModel
{
    /** @var Post[] Переданные новости */
    public $posts;

    /**
     * NewsViewModel constructor.
     * @param Post[] $posts
     */
    function __construct(array $posts)
    {
        $this->posts = $posts;
    }
}