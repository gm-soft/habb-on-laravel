<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:10 PM
 */

namespace App\Traits;


use App\ViewModels\Shared\Link;

trait FrontDataTrait
{
    /** @var Link[] */
    public $attached_tournaments_links;
}