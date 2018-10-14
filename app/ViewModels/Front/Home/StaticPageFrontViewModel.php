<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/14/18
 * Time: 9:46 AM
 */

namespace App\ViewModels\Front\Home;


use App\Models\StaticPage;
use App\Traits\FrontDataTrait;

class StaticPageFrontViewModel
{
    use FrontDataTrait;

    /** @var string */
    public $pageTitle;

    /** @var StaticPage */
    public $staticPage;
}