<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Post
 * @package App\Models
 *
 * @property string title
 * @property string content
 * @property int views
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Post extends Ardent
{
    use SoftDeletes;

    public static $rules = array(
        'title'     => 'required|between:2,100',
        'content'   => 'required|between:2,2000',
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
        $contentLength = strlen($this->content);
        if ($length < $contentLength) {
            $returnable = substr($this->content, 0, $length);
            return $returnable. "...";
        }
        return $this->content;
    }
}
