<?php

namespace App\Models;

use App\Interfaces\ISelectableOption;
use App\Interfaces\ITournamentParticipant;
use Carbon\Carbon;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Team
 * @package App
 *
 * @property int id
 * @property string name
 * @property string city
 * @property string comment
 * @property array gamer_ids
 * @property array gamer_roles
 *
 * @property TeamScore[] scores
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class Team extends Ardent implements ISelectableOption, ITournamentParticipant
{
    protected $table = "teams";
    protected $casts = [
        'gamer_ids' => 'array',
        'gamer_roles' => 'array'
    ];
    public static $rules = [
        'name' => 'between:1,100'
    ];

    /**
     * Массив привязанных очков TeamScore
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores()
    {
        return $this->hasMany('App\Models\TeamScore');
    }

    public function getGamerIdsAsString() {
        return join(', ', $this->gamer_ids);
    }

    public function getGamerRolesAsString() {
        return join(', ', $this->gamer_roles);
    }

    /**
     * @param bool $all
     * @return Gamer[]
     */
    public function getGamers($all = true) {
        $result = [];
        $gamerIds = $this->gamer_ids;
        $gamerRoles = $this->gamer_roles;

        for ($i = 0; $i < count($gamerIds); $i++) {

            $gamer_id = $gamerIds[$i];
            if ($all == false && ($gamerRoles[$i] == 'coach' || $gamerRoles[$i] == 'reserve')) continue;

            $gamer = Gamer::find($gamer_id);
            $gamer["role"] = isset($gamerRoles[$i]) ? $gamerRoles[$i] : null;
            $result[] = $gamer;
        }
        return $result;
    }

    #region Attributes
    public function getGamerIdsAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setGamerIdsAttribute($value) {
        $this->attributes['gamer_ids']= join(',', $value);
    }

    public function getGamerRolesAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setGamerRolesAttribute($value) {
        $this->attributes['gamer_roles']= join(',', $value);
    }

    #endregion

    public function getIdentifier()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name." [ID ".$this->id."]";
    }

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

    public function addScoreValue($gameName, $scoreValueAdded)
    {
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

    public static function getSelectableOptionArray($withEmpty = true)
    {
        /** @var Team[] $gamers */
        $gamers = self::all();
        $gamerOptionList = [];
        if ($withEmpty == true) {
            $gamerOptionList[''] = 'Выберите участника';
        }
        foreach ($gamers as $gamer) {
            $gamerOptionList[$gamer->getIdentifier()] = $gamer->getName();
        }
        return $gamerOptionList;
    }

    /**
     * Возвращает список электронных адресов игроков
     * @param bool $all
     * @return array
     */
    public function getGamerEmailAddresses($all = true) {
        $addresses = [];
        $gamers = $this->getGamers($all);
        foreach ($gamers as $gamer) {
            $addresses[] = $gamer->email;
        }
        return $addresses;
    }
}
