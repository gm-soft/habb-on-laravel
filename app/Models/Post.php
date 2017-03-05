<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Facades\Ardent;

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
        'title'     => 'required|between:2:100',
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

    public function getPublicationDate($format = "d.m.Y"){

        return $this->created_at->format($format);
    }
}
