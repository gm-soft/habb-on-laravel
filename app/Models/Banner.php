<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Banner
 * @property int id
 * @property string title
 * @property string subtitle
 * @property string image_path
 * @property boolean attached_to_main_page
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon delete_at
 * @package App\Models
 */
class Banner extends Ardent
{
    use SoftDeletes;

    public static $rules = [
        'title' => 'between:0,100',
        'subtitle' => 'between:0,200',
        'image_path' => 'required',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $table = "banners";

    // Связь many-to-many от Ardent
    public static $relationsData = array(
        'tournaments'  => array(self::BELONGS_TO_MANY, 'Tournament', 'table' => 'tournament_banner')
    );

    // стандартная связь many-to-many от laravel

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments(){
        return $this->belongsToMany(Tournament::class, 'tournament_banner');
    }
}
