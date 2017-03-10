<?php

namespace App\Models;


use App\Helpers\Constants;
use App\Interfaces\IScoreInstance;
use Carbon\Carbon;
use LaravelArdent\Ardent\Ardent;

/**
 * Class TeamScore
 * @package App\Models
 * @property int id
 * @property int team_id Айди аккаунта геймера, к которому привязана запись
 * @property string game_name Название дисциплины, к которой относится запись. Может быть несколько записей
 * @property int total_value Общее значение набранных очков
 * @property int total_change Показатель последнего изменения очков. Может быть больше или меньше нуля
 * @property int month_value Показатель очков на начало месяца. Для того, чтобы считать, какой прирост за месяц произошел
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class TeamScore extends Ardent implements IScoreInstance
{
    protected $fillable = ['game_name'];
    protected $table = 'team_scores';

    public static $rules = [
        'name' => 'between:2,100'
    ];


    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * Возвращает набор очков для создания объекта
     * @param array|null $games
     * @return TeamScore[]
     */
    static function getScoreSet($games = null)
    {
        $games = !is_null($games) ? $games : Constants::getGameArray();
        $result = [];
        foreach ($games as $game) {
            $result[] = new self(['game_name' => $game]);
        }
        return $result;
    }
}
