<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/13/18
 * Time: 8:23 PM
 */

namespace App\ViewModels\Shared;


class Link
{
    /** @var string */
    public $url;

    /** @var string */
    public $title;

    /**
     * @param $url
     * @param $title
     * @return Link
     */
    public static function create($url, $title){
        $link = new Link;
        $link->url = $url;
        $link->title = $title;

        return $link;
    }
}