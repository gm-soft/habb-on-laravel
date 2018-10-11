<?php

namespace App\Models;

use App\Interfaces\ITournamentParticipant;
use Carbon\Carbon;
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
 * @property Carbon started_at - Начало турнира
 * @property Carbon reg_closed_at - Время закрытия регистрации
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Tournament extends Ardent
{
    use SoftDeletes;

    protected $table = 'tournaments';
    protected $dates = [
        'deleted_at',
        'started_at',
        'reg_closed_at'
    ];

    public static $rules = [
        'name' => 'required|between:1,100',
        'public_description' => 'required|between:0,500'
    ];

    // Связь many-to-many от Ardent
    public static $relationsData = array(
        'banners'  => array(self::BELONGS_TO_MANY, 'Banner', 'table' => 'tournament_banner')
    );

    public function getStartedAt($format = "Y-m-d"){
        return $this->started_at->format($format);
    }

    public function getRegClosedAt($format = "Y-m-d"){
        return $this->reg_closed_at->format($format);
    }

    // стандартная связь many-to-many от laravel
    public function banners(){
        return $this->belongsToMany(Banner::class, 'tournament_banner');
    }
}
