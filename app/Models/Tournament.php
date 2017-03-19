<?php

namespace App\Models;

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
 * @property string tournament_type - Тип турнира. team или gamer
 * @property int participant_max_count - Максимальное кол-во участников
 *
 * @property array participant_ids - Массив айдишников участников
 * @property array participant_scores - Массив очков, полученных участниками в рамках турнира
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
    const Team = 'team';
    const Gamer = 'gamer';

    protected $table = 'tournaments';
    protected $dates = [
        'deleted_at', 'started_at', 'reg_closed_at'
    ];
    protected $casts = [
        'participant_ids' => 'array',
        'participant_scores' => 'array'
    ];
    public static $rules = [
        'name' => 'required|between:1,100',
        'public_description' => 'required|between:0,500'
    ];

    #region getAsString
    public function getParticipantIdsAsString() {
        return join(', ', $this->participant_ids);
    }

    public function getParticipantScoresAsString() {
        return join(', ', $this->participant_scores);
    }
    #endregion

    #region Attributes
    public function getParticipantIdsAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setParticipantIdsAttribute($value) {
        $this->attributes['participant_ids'] = join(',', $value);
    }

    public function getParticipantScoresAttribute($value){
        $result = explode(',', $value);
        foreach ($result as $key => $value) {
            $result[$key] = intval($value);
        }
        return $result;
    }

    public function setParticipantScoresAttribute($value) {
        $this->attributes['participant_scores'] = join(',', $value);
    }

    #endregion

    /**
     *
     */
    public function getParticipants() {

    }
}
