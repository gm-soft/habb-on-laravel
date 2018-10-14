<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Traits\HashtagTrait;
use App\Traits\IHasHtmlContentTrait;
use App\Traits\TimestampModelTrait;
use Carbon\Carbon;
use DB;
use Html;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Post
 *
 * @package App\Models
 * @property int $id
 * @property string $title Заголовок статьи
 * @property string $content Контент статьи
 * @property int $views ПРосмотры статьи
 * @property string $announce_image Картинка для анонса
 * @property string hashtags
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @mixin \Eloquent
 */
class Post extends Ardent
{
    use SoftDeletes, TimestampModelTrait, HashtagTrait, IHasHtmlContentTrait;

    public static $rules = array(
        'title'          => 'required|between:2,100',
        'content'        => 'required|between:2,10000',
        'announce_image' => 'required|regex:/'.Constants::AnnounceImagePathRegexPattern.'/',
        'hashtags'       => 'max:'.Constants::HashTagFieldMaxLength
    );
    protected $table = "posts";

    protected $fillable = [
        'title',
        'content'
    ];
    protected $dates = [
        "deleted_at"
    ];

    public function getPublicationDate($format = "d.m.Y"){

        return $this->updated_at->format($format);
    }

    /**
     * Возвращает контент для укороченного представления
     * @param int $length
     * @return string
     */
    public function getContentShortly($length = 100) {

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

    public static function getTop($limit, $postIdToFiler = null){

        $query = self::query()
            ->select()
            ->where('deleted_at', '=', null);

        if (isset($postIdToFiler))
            $query = $query->where('id', '<>', $postIdToFiler);

        return $query
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }

    public static function searchByHashtags($hashtags, $limit = null){

        $query = self::query()
            ->select()
            ->where('deleted_at', '=', null);

        // если преедали массив в качестве аргумента
        if (is_array($hashtags)){

            // массив может быть пустым, не будем с таким работать
            if (!empty($hashtags)) {

                // первый фильтр через where всегда
                $query = $query->where('hashtags', 'LIKE', "%{$hashtags[0]}%");

                if (count($hashtags) > 1)
                {
                    // последующие уже через orWhere
                    for($index = 1; $index < count($hashtags); $index++)
                        $query = $query->orWhere('hashtags', 'LIKE', "%{$hashtags[$index]}%");
                }
            }

        } else {
            // если передали не массив, а строку (или другой объект)
            $query = $query->where('hashtags', 'LIKE', "%{$hashtags}%");
        }

        if (isset($limit))
            $query = $query->limit($limit);


        return $query
            ->orderByDesc('created_at')
            ->get();
    }
}
