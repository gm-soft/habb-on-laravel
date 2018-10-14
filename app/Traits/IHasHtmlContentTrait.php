<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/14/18
 * Time: 8:59 AM
 */

namespace App\Traits;


use Html;

trait IHasHtmlContentTrait
{
    public function getContentLength(){
        return strlen($this->content);
    }

    /**
     * Кодирует разметку html в пригодную для сохранения в базе
     * @param $content
     */
    public function encodeHtmlContent($content) {
        $this->content = HTML::entities($content);
    }

    /**
     * Декодирует сохраненную кодированную разметку в базе в html-вью
     */
    public function decodeHtmlContent() {
        $this->content = HTML::decode($this->content);
    }
}