<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Traits\HashtagTrait;
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
 * @property string hashtags
 * @property Team[] teamParticipants
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Tournament extends Ardent
{
    use SoftDeletes, TimestampModelTrait, HashtagTrait;

    const TournamentBanner_ManyToManyTableName = "tournament_banner";


    protected $table = 'tournaments';
    protected $dates = [
        'deleted_at',
        'event_date',
    ];

    public static $rules = [
        'name'                  => 'required|between:1,100',
        'public_description'    => 'required|max:10000',
        'hashtags'              => 'max:'.Constants::HashTagFieldMaxLength
    ];

    // Связь many-to-many от Ardent
    public static $relationsData = array(
        'banners'           => [self::BELONGS_TO_MANY, Banner::class, 'table' => self::TournamentBanner_ManyToManyTableName],

        // ключ должен называться как называается имя метода связи (https://www.sitepoint.com/ardent-laravel-models-steroids/)
        'teamParticipants'           => [self::BELONGS_TO_MANY, Team::class, 'table' => Team::TeamTournamentParticipants_ManyToManyTableName]
    );

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
        return $this->belongsToMany(Banner::class, self::TournamentBanner_ManyToManyTableName);
    }

    public function teamParticipants(){
        return $this->belongsToMany(Team::class, Team::TeamTournamentParticipants_ManyToManyTableName);
    }

    public function EventDate($format = "d.m.Y"){
        return $this->event_date->format($format);
    }

    public static function getActive() {

        return \DB::table('tournaments')
            ->where('event_date', '>=', Carbon::now())
            ->get();
    }

    public static function getAttachedToNavIds($limit) {

        return \DB::table('tournaments')
            ->where('attached_to_nav', '=', true)
            ->orderByDesc('created_at')
            ->select('id', 'name')
            ->limit($limit)
            ->get();
    }
}
