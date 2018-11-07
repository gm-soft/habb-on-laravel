<?php

namespace App\Models;

use App\Interfaces\ISelectableOption;
use App\Interfaces\ITournamentParticipant;
use App\Traits\TimestampModelTrait;
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
 *
 * @property int captain_gamer_id
 * @property Gamer captain_gamer
 *
 * @property int second_gamer_id
 * @property Gamer second_gamer
 *
 * @property int third_gamer_id
 * @property Gamer third_gamer
 *
 * @property int forth_gamer_id
 * @property Gamer forth_gamer
 *
 * @property int fifth_gamer_id
 * @property Gamer fifth_gamer
 *
 * @property int optional_gamer_id
 * @property Gamer optional_gamer
 *
 * @property Carbon deleted_at
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class Team extends Ardent implements ISelectableOption, ITournamentParticipant
{
    use TimestampModelTrait;

    const Captain_ForeignColumn         = "captain_gamer_id";
    const Captain_Field                 = "captain";

    const SecondGamer_ForeignColumn     = "second_gamer_id";
    const SecondGamer_Field             = "second_gamer";

    const ThirdGamer_ForeignColumn      = "third_gamer_id";
    const ThirdGamer_Field              = "third_gamer";

    const ForthGamer_ForeignColumn      = "forth_gamer_id";
    const ForthGamer_Field              = "forth_gamer";

    const FifthGamer_ForeignColumn      = "fifth_gamer_id";
    const FifthGamer_Field              = "fifth_gamer";

    const OptionalGamer_ForeignColumn   = "optional_gamer_id";
    const OptionalGamer_Field           = "optional_gamer";

    const Gamer_ModelName = "App\Models\Gamer";

    const TeamTournamentParticipants_ManyToManyTableName = "team_tournament_participants";

    protected $table = "teams";

    protected $fillable = array(
        'name',
        'city',
        'comment',
        self::Captain_ForeignColumn,
        self::SecondGamer_ForeignColumn,
        self::ThirdGamer_ForeignColumn,
        self::ForthGamer_ForeignColumn,
        self::FifthGamer_ForeignColumn ,
        self::OptionalGamer_ForeignColumn,
    );

    public static $rules = [
        'name'                          => 'between:1,100',
        self::Captain_ForeignColumn     => 'required',
        self::ThirdGamer_ForeignColumn  => 'required',
        self::ForthGamer_ForeignColumn  => 'required',
        self::FifthGamer_ForeignColumn  => 'required',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public static $relationsData = [
        self::Captain_Field         => [self::HAS_ONE, Gamer::class],
        self::SecondGamer_Field     => [self::HAS_ONE, Gamer::class],
        self::ThirdGamer_Field      => [self::HAS_ONE, Gamer::class],
        self::ForthGamer_Field      => [self::HAS_ONE, Gamer::class],
        self::FifthGamer_Field      => [self::HAS_ONE, Gamer::class],
        self::OptionalGamer_Field   => [self::HAS_ONE, Gamer::class],

        // ключ должен называться как называается имя метода связи
        'tournamentsThatTakePart'           => [self::BELONGS_TO_MANY, Tournament::class, 'table' => self::TeamTournamentParticipants_ManyToManyTableName]
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function captain()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::Captain_ForeignColumn );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function secondGamer()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::SecondGamer_ForeignColumn );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function thirdGamer()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::ThirdGamer_ForeignColumn );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function forthGamer()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::ForthGamer_ForeignColumn);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function fifthGamer()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::FifthGamer_ForeignColumn );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Gamer
     */
    public function optionalGamer()
    {
        return $this->hasOne(self::Gamer_ModelName, 'id', self::OptionalGamer_ForeignColumn);
    }

    public function tournamentsThatTakePart(){
        return $this->belongsToMany(Tournament::class, self::TeamTournamentParticipants_ManyToManyTableName);
    }


    #region Interfaces

    public function getIdentifier()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name." [ID ".$this->id."]";
    }

    public function getClass()
    {
        return strtolower(class_basename($this));
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

    #endregion
}
