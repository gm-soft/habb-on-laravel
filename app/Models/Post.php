<?php

namespace App\Models;

use Carbon\Carbon;
use Html;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Post
 * @package App\Models
 *
 * @property string title
 * @property string content
 * @property int views
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Post extends Ardent
{
    use SoftDeletes;

    public static $rules = array(
        'title'     => 'required|between:2,100',
        'content'   => 'required|between:2,5000',
    );
    protected $table = "posts";

    protected $fillable = [
        'title',
        'content'
    ];
    protected $dates = [
        "deleted_at"
    ];
    protected $properties = [

    ];

    public function getPublicationDate($format = "d.m.Y"){

        return $this->updated_at->format($format);
    }

    /**
     * Возвращает контент для укороченного представления
     * @param int $length
     * @return string
     */
    public function getContentShortly($length = 30) {

        $content = $this->contentToHtml();
        $contentLength = strlen($content);
        if ($length < $contentLength) {
            $returnable = substr($content, 0, $length);
            return $returnable. "...";
        }
        return $this->content;
    }

    public function contentToHtml(){
        $result = HTML::decode($this->content);
        return $result;
    }

    /**
     * ВОзвращает размер статьи
     * @return int
     */
    public function getContentLength() {
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

    public function CreatedAt($format = "d.m.Y"){
        return $this->created_at->format($format);
    }

    public function UpdatedAt($format = "d.m.Y"){
        return $this->updated_at->format($format);
    }
}
