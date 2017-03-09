<?php

namespace App\Models;

use App\Helpers\Constants;
use Carbon\Carbon;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Score
 * @package App
 * @property int id
 * @property int gamer_id Айди аккаунта геймера, к которому привязана запись
 * @property array scores
 * @property string game_name Название дисциплины, к которой относится запись. Может быть несколько записей
 * @property int total_value Общее значение набранных очков
 * @property int total_change Показатель последнего изменения очков. Может быть больше или меньше нуля
 * @property int month_value Показатель очков на начало месяца. Для того, чтобы считать, какой прирост за месяц произошел
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class GamerScore extends Ardent
{
    /**
     * @var array
     */
    public $scoreArray = null;

    protected $table = 'gamer_scores';

    protected $casts = [
        'scores' => 'array'
    ];

    public function __construct(array $attributes = array())
    {
        if (is_null($this->scoreArray)) {

            foreach ($this as $this->scores) {

            }
        }
        parent::__construct($attributes);
    }


    public function gamer()
    {
        return $this->belongsTo('App\Models\Gamer');
    }

    /**
     * Возвращает массив стандартных очков
     * @param string|null $byGame
     * @return array
     */
    public static function getScores($byGame = null) {

        return $result;
    }
}
