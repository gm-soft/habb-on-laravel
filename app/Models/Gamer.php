<?php

namespace App\Models;

use App\Helpers\Constants;
use App\Helpers\MiscUtils;
use App\Interfaces\ISelectableOption;
use App\Interfaces\ITournamentParticipant;
use App\Traits\TimestampModelTrait;
use App\User;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use DB;
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
 *
 * @property bool is_active
 *
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
 * @property Tournament[] guestInTournaments
 *
 * @property int external_service_id
 * @property ExternalService externalService
 */
class Gamer extends Ardent implements ISelectableOption, ITournamentParticipant
{
    use FormAccessible, SoftDeletes, TimestampModelTrait;

    public static $rules = [
        'name'      => 'required|regex:/^['.Constants::RussianAlphabet.'A-Za-z]+$/',
        'last_name' => 'required|regex:/^['.Constants::RussianAlphabet.'A-Za-z]+$/',
        'email'     => 'required|between:3,100|email|unique:gamers',
        'phone'     => 'required|regex:/^[+0-9()-]+$/|unique:gamers'
    ];

    public static function getHabbIdRegistrationRules(){
        return array_add(self::$rules, 'vk_page', 'required|regex:/'.Constants::VkPageRegexPattern.'/');
    }

    /**
     * @return array
     */
    public static function getApiRules(){
        return array_add(self::getHabbIdRegistrationRules(), 'city', 'required|regex:/^['.Constants::RussianAlphabet.'A-Za-z]+$/');
    }

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
        'users'                 => [self::BELONGS_TO, User::class],
        'teams'                 => [self::BELONGS_TO, Team::class],
        'external_services'     => [self::BELONGS_TO, ExternalService::class],
        'guest_in_tournaments'  => [self::BELONGS_TO_MANY, Tournament::class, 'table' => Tournament::Gamers_EventGuests_ManyToManyTableName]
    ];

    public static function getActiveAccounts(){
        return self::where('is_active', '=', true);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function externalService(){
        return $this->belongsTo(Team::class, 'external_service_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, Team::Captain_ForeignColumn);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Tournament[]
     */
    public function guestInTournaments(){
        return $this->belongsToMany(Tournament::class, Tournament::Gamers_EventGuests_ManyToManyTableName);
    }

    /**
     * @return array
     */
    public function guestInTournamentsIds(){
        $tournaments = $this->guestInTournaments;
        $ids = [];
        foreach ($tournaments as $tournament)
            $ids[] = $tournament->id;

        return $ids;
    }

    public function getTeamsWhereTakeApart(){
        return Team::getTeamsWhereGamerTakeApart($this->id);
    }

    #region Кастомные функции модели

    public function getGamerAge(){

        if (is_null($this->birthday))
            return null;

        Carbon::setLocale('ru');
        $now = time();
        $birthday = $this->birthday->getTimestamp();
        return Carbon::createFromTimestamp($now - $birthday)->diffInYears();
    }

    public function getBirthday($format = "d.m.Y"){

        if (is_null($this->birthday))
            return null;

        return $this->birthday->format($format);
    }

    public function getFullName() {
        return $this->name." ".$this->last_name;
    }
    #endregion

    #region Реализация интерфейсов


    public function getSecondaryGamesAttribute($value){
        $result = !is_null($value) ? explode(',', $value) : $value;
        return $result;
    }

    public function setSecondaryGamesAttribute($value) {
        if (!is_null($value))
            $value = join(',', $value);

        $this->attributes['secondary_games']= $value;
    }

    public function getSecondaryGamesAsString() {

        if (is_null($this->secondary_games))
            return $this->secondary_games;

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

    public function getClass()
    {
        return strtolower(class_basename($this));
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

    /**
     * Возвращает запись геймера, если есть в базе. Иначе - null
     * @param string $phone
     * @return Gamer|\Illuminate\Database\Eloquent\Model|null
     */
    public static function findByPhone($phone) {
        $phone = MiscUtils::formatPhone($phone);

        return self::where('phone' , '=', $phone)->first();
    }

    /**
     * Возвращает запись геймера, если есть в базе. Иначе - null
     * @param string $phone
     * @param string $email
     * @return Gamer|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null
     */
    public static function getGamerFoundByEmailAndPhone($phone, $email) {

        if (isset($phone))
            $phone = MiscUtils::formatPhone($phone);

        $gamer = self::where('phone' , '=', $phone)->orWhere('email' , '=', $email)->first();
        return $gamer;
    }
}
