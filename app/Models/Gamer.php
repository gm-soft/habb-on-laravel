<?php

namespace App\Models;

use App\Interfaces\ISelectableOption;
use App\Interfaces\ITournamentParticipant;
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
 * @property Carbon birthday
 * @property string city
 * @property string vk_page
 * @property string status
 * @property string institution
 * @property string comment
 * @property string lead_id
 *
 * @property string primary_game
 * @property array secondary_games
 *
 * @property Carbon updated_at
 * @property Carbon created_at
 * @property Carbon deleted_at
 *
 * @property GamerScore[] scores
 */
class Gamer extends Ardent implements ISelectableOption, ITournamentParticipant
{
    use FormAccessible, SoftDeletes;

    public static $rules = [
        'name'      => 'required',
        'last_name' => 'required',
        'email'     => 'required|between:3,100|email|unique:gamers',
        'phone'     => 'required|unique:gamers',
    ];

    protected $table = "gamers";

    protected $fillable = array(
        'name', 'last_name', 'phone', 'email', 'birthday', 'city', 'vk_page', 'status', 'institution', 'comment', 'lead_id'
    );

    protected $dates = [
        'birthday', 'deleted_at'
    ];
    protected $casts = [
        'secondary_games' => 'array'
    ];
    public static $relationsData = [
        'scores' => [self::HAS_MANY, 'GamerScore'],
        'users' => [self::BELONGS_TO, 'User']
    ];

    /**
     * Массив привязанных очков GamerScore
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        $scores = $this->hasMany('App\Models\GamerScore');
        return $scores;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    #region Кастомные функции модели
    public function getGamerAge(){
        Carbon::setLocale('ru');
        $now = time();
        $birthday = $this->birthday->getTimestamp();
        return Carbon::createFromTimestamp($now - $birthday)->diffInYears();
    }

    public function getBirthday($format = "d.m.Y"){
        return $this->birthday->format($format);
    }

    public function getFullName() {
        return $this->name." ".$this->last_name;
    }
    #endregion

    #region еРеализация интерфейсов
    /**
     * Добавляет переданные аргументом очки. Сразу же сохраняет и возвращает результат
     * @param string $gameName
     * @param int $scoreValueAdded
     * @return bool
     */
    public function addScoreValue($gameName, $scoreValueAdded) {
        $score = $this->getScore($gameName);
        if (is_null($score)) {
            $this->errors()->add('NotFound', 'Привязанные очки к игре '.$gameName.' не найдены');
            return false;
        }
        $score->total_change = $scoreValueAdded;
        $score->total_value = $scoreValueAdded + $score->total_value;

        $result = $score->update();
        return $result;
    }

    public function getSecondaryGamesAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setSecondaryGamesAttribute($value) {
        $this->attributes['secondary_games']= join(',', $value);
    }

    public function getSecondaryGamesAsString() {
        return join(', ', $this->secondary_games);
    }


    public function getName()
    {
        return $this->name." ".$this->last_name." [".$this->phone."]";
    }

    /**
     * Индивидуальный идентификатор
     * @return int
     */
    public function getIdentifier()
    {
        return $this->id;
    }

    /**
     * Возвращает определенный
     * @param string $gameName
     * @return GamerScore|null
     */
    public function getScore($gameName)
    {
        $scores = $this->scores;
        foreach ($scores as $score) {
            if ($score->game_name != $gameName) continue;
            return $score;
        }
        return null;
    }

    public function getClass()
    {
        return strtolower(class_basename($this));
    }

    /**
     * @return GamerScore[]|array
     */
    public function getScores(){
        if (is_null($this->scores) || count($this->scores) == 0) {
            $this->scores = GamerScore::getScoreSet();
            $this->scores()->saveMany($this->scores);
        }
        return $this->scores;
    }


    public static function getSelectableOptionArray($withEmpty = true)
    {
        /** @var Gamer[] $gamers */
        $gamers = self::all();
        $gamerOptionList = [];

        if ($withEmpty == true) {
            $gamerOptionList['null'] = 'Без игрока';
        }

        foreach ($gamers as $gamer) {

            $id = $gamer->getIdentifier();
            $name = $gamer->getName();
            $fullName = "$name [ID$id]";

            $gamerOptionList[$id] = $fullName;
        }
        return $gamerOptionList;
    }
    #endregion
}
