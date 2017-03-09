<?php

namespace App\Models;

use App\Helpers\Constants;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Score
 * @package App
 * @property int id
 * @property int gamer_id Айди аккаунта геймера, к которому привязана запись
 * @property string game_name Название дисциплины, к которой относится запись. Может быть несколько записей
 * @property int total_value Общее значение набранных очков
 * @property int total_change Показатель последнего изменения очков. Может быть больше или меньше нуля
 * @property int month_value Показатель очков на начало месяца. Для того, чтобы считать, какой прирост за месяц произошел
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class GamerScore extends Ardent
{
    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'gamer_scores';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['game_name'];


    public function gamer()
    {
        return $this->belongsTo('App\Models\Gamer');
    }

    /**
     * Возвращает массив стандартных очков
     * @param null $games
     * @return array
     */
    public static function getScoreSet($games = null) {
        $games = !is_null($games) ? $games : Constants::getGameArray();
        $result = [];
        foreach ($games as $game) {
            $result[] = new self(['game_name' => $game]);
        }
        return $result;
    }
}
