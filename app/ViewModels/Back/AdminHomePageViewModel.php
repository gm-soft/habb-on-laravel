<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 12/8/18
 * Time: 9:47 PM
 */

namespace App\ViewModels\Back;


use App\Models\Post;

class AdminHomePageViewModel
{
    /** @var int */
    public $accounts_count;

    /** @var int */
    public $active_habb_accounts_count;

    /** @var int */
    public $non_action_habb_accounts_count;

    //----------

    /** @var int */
    public $posts_count;

    /** @var Post[] */
    public $top_viewed_posts;

    //----

    /** @var array */
    public $gamers_by_days_labels;

    /** @var array */
    public $gamers_by_days_values;
}