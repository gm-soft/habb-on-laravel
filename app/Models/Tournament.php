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
 * @property string tournament_type - Тип турнира. team или gamer
 * @property string game - Игровая дисциплина
 * @property int participant_max_count - Максимальное кол-во участников
 *
 * @property array participant_ids - Массив айдишников участников
 * @property int[] participant_scores - Массив очков, полученных участниками в рамках турнира
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
        'deleted_at',
        'started_at',
        'reg_closed_at'
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

        if (is_null($value)) return $value;

        $result = explode(',', $value);
        return $result;
    }

    public function setParticipantIdsAttribute($value) {
        $this->attributes['participant_ids'] = is_null($value) ? $value : join(',', $value);
    }

    public function getParticipantScoresAttribute($value){

        if (is_null($value)) return $value;

        $scores = explode(',', $value);
        foreach ($scores as $key => $value) {
            $scores[$key] = intval($value);
        }
        return $scores;
    }

    public function setParticipantScoresAttribute($value) {
        $this->attributes['participant_scores'] = is_null($value) ? $value : join(',', $value);
    }

    #endregion

    /**
     * Возвращает конкретного участника
     * @param $id
     * @return ITournamentParticipant|null
     */
    public function getParticipant($id) {
        /** @var ITournamentParticipant $result */
        $result = null;
        foreach ($this->participant_ids as $participant_id) {

            if ($id != $participant_id) continue;

            if ($this->tournament_type == self::Gamer) {
                $result = Gamer::find($id);
            } else {
                $result = Team::find($id);
            }
            break;
        }
        return $result;
    }

    /**
     * Возвращает массив участников турнира
     * @return ITournamentParticipant[]
     */
    public function getParticipants() {

        if (is_null($this->participant_ids)) return null;
        /** @var ITournamentParticipant[] $result */
        $result = [];
        foreach ($this->participant_ids as $participant_id) {

            if ($this->tournament_type == self::Gamer) {
                $result[] = Gamer::find($participant_id);
            } else {
                $result[] = Team::find($participant_id);
            }
        }
        return $result;
    }

    /**
     * Добавляет участника по его id. Автоматически присваивает 0 к очкам
     * @param $id
     * @param int $score
     */
    public function addParticipant($id, $score = 0) {
        $this->participant_ids[] = $id;
        $this->participant_scores[] = $score;
    }

    /**
     * Находит участника по id и удаляет его из массива. ОЧки так же удаляются
     * @param $id
     */
    public function removeParticipant($id) {
        $tmpIds = [];
        $tmpScores = [];

        for($i = 0; $i < count($this->participant_ids);$i++) {

            if ($this->participant_ids[$i] == $id) continue;
            $tmpIds[]       = $this->participant_ids[$i];
            $tmpScores[]    = $this->participant_scores[$i];
        }
        $this->participant_ids      = $tmpIds;
        $this->participant_scores   = $tmpScores;

    }

    /**
     * Устанавливает новый массив значений айдишников. Ищется и присваивается каждому айдишнику егшо значение очков.
     * Если не найдено, то присваивается ноль
     * @param array $ids
     */
    public function updateParticipantIdsArray(array $ids) {
        $tmpIds = [];
        $tmpScores = [];
        for($i = 0; $i < count($ids); $i++) {

            $tmpIds[] = $ids[$i];
            $tmpScores[] = $this->getScoreValueOfId($ids[$i]);
        }
        $this->participant_ids = $tmpIds;
        $this->participant_scores = $tmpScores;
    }


    public function getParticipantCount() {
        return count($this->participant_ids);
    }

    public function getStartedAt($format = "Y-m-d"){
        return $this->started_at->format($format);
    }

    public function getRegClosedAt($format = "Y-m-d"){
        return $this->reg_closed_at->format($format);
    }
}
