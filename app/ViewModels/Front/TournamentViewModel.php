<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 6:38 PM
 */

namespace App\ViewModels\Front;


use App\Models\Banner;
use App\Models\Post;
use App\Models\Tournament;

class TournamentViewModel
{
    /** @var Tournament */
    public $tournament;

    /** @var Post[] */
    public $topNews;

    /** @var Banner[] */
    public $banners;

    /** @var int */
    public $banners_count;
}