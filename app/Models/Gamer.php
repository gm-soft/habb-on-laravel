<?php

namespace App\Models;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Gamer
 * @package App\Models
 *
 * @property int id
 * @property string name
 * @property string last_name
 * @property string phone
 * @property string email
 * @property \DateTime birthday
 * @property string city
 * @property string vk_page
 * @property string status
 * @property string institution
 * @property string comment
 * @property string lead_id
 * @property \Datetime updated_at
 * @property \Datetime created_at
 *
 * @property GamerScore scores
 */
class Gamer extends Ardent
{
    use FormAccessible;

    public static function rules ($id = 0) {
        return array(
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required|between:5,100|email|unique:gamers,email' . ($id ? ",$id" : ''),
            'phone'     => 'required|unique:gamers,phone' . ($id ? ",$id" : ''),
        );
    }
    protected $table = "gamers";
    /*protected $attributes = array(

        'city' => 'Астана',
        'status' => 'dumbass',
        'institution' => '-',
        'comment' => 'Комментарий отсутствует'
    );
    */
    protected $fillable = array(
        'name', 'last_name', 'phone', 'email', 'birthday', 'city', 'vk_page', 'status', 'institution', 'comment', 'lead_id'
    );

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes($this->attributes, true);
        parent::__construct($attributes);
    }

    protected $dates = ['birthday'];

    /**
     * Массив привязанных очков GamerScore
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Models\GamerScore');
    }

    public function getGamerAge(){
        Carbon::setLocale('ru');
        $now = time();
        $birthday = $this->birthday->getTimestamp();
        return Carbon::createFromTimestamp($now - $birthday)->diffInYears();
    }

    public function getBirthday($format = "d.m.Y"){
        return $this->birthday->format($format);
    }

    /**
     * Возвращает определенный
     * @param string $gameName
     * @return GamerScore|null
     */
    public function getScoreByGame($gameName) {
        $scores = $this->scores;
        foreach ($scores as $score) {
            if ($score->game_name != $gameName) continue;
            return $score;
        }
        return null;
    }

    /**
     * @param string $gameName
     * @param int $scoreValueAdded
     * @return bool
     */
    public function addScoreValue($gameName, $scoreValueAdded) {
        $gamerScore = $this->getScoreByGame($gameName);
        if (is_null($gamerScore)) {
            $this->errors()->add('NotFound', 'Привязанные очки к игре '.$gameName.' не найдены');
            return false;
        }
        $gamerScore->total_change = $scoreValueAdded;
        $gamerScore->total_value = $scoreValueAdded + $gamerScore->total_value;

        $result = $gamerScore->update();
        return $result;
    }


}
