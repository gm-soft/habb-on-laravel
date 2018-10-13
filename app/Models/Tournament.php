<?php

namespace App\Models;

use App\Interfaces\ITournamentParticipant;
use App\Traits\TimestampModelTrait;
use Carbon\Carbon;
use Html;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Tournament
 * @package App\Models
 *
 *
 * @property int id - ID сущности
 * @property string name - Название турнира
 * @property string comment - Комментарий пользователя
 * @property string public_description - Публичное описание, доступное открыто
 *
 * @property Carbon event_date - Дата турнира
 * @property boolean attached_to_nav
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Tournament extends Ardent
{
    use SoftDeletes, TimestampModelTrait;

    protected $table = 'tournaments';
    protected $dates = [
        'deleted_at',
        'event_date',
    ];

    public static $rules = [
        'name' => 'required|between:1,100',
        'public_description' => 'required|between:0,500'
    ];

    // Связь many-to-many от Ardent
    public static $relationsData = array(
        'banners'  => array(self::BELONGS_TO_MANY, 'Banner', 'table' => 'tournament_banner')
    );

    public function getEventDate($format = "Y-m-d"){
        return $this->event_date->format($format);
    }

    /**
     * Кодирует разметку html в пригодную для сохранения в базе
     * @param $content
     */
    public function encodeHtmlDescription($content) {
        $this->public_description = HTML::entities($content);
    }

    /**
     * Декодирует сохраненную кодированную разметку в базе в html-вью
     */
    public function decodeHtmlDescription() {
        $this->public_description = HTML::decode($this->public_description);
    }

    // стандартная связь many-to-many от laravel
    public function banners(){
        return $this->belongsToMany(Banner::class, 'tournament_banner');
    }

    public function EventDate($format = "d.m.Y"){
        return $this->event_date->format($format);
    }

    public static function getActive() {

        return \DB::table('tournaments')
            ->where('event_date', '>=', Carbon::now())
            ->get();
    }
}
