<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/11/18
 * Time: 9:15 PM
 */

namespace App\ViewModels\Back\Banner;


use App\Models\Banner;
use App\Models\Tournament;
use App\ViewModels\Back\SelectOptionItem;

class BannerEditViewModel
{
    /** @var Banner */
    public $banner;

    /** @var SelectOptionItem[] */
    public $select_options;

    /** @var Tournament[] */
    public $available_tournaments;

    /** @var int[] */
    public $attached_to_banners_ids;
}