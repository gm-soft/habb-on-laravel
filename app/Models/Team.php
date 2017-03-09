<?php

namespace App\Models;

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
 *
 * @property TeamScore[] scores
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class Team extends Ardent
{
    protected $table = "teams";
    protected $casts = [
        'gamer_ids' => 'array'
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

    /**
     * @return Gamer[]
     */
    public function getGamers() {
        $result = [];
        foreach ($this->gamer_ids as $gamer_id) {
            $result[] = Gamer::find($gamer_id);
        }
        return $result;
    }

    public function getGamerIdsAttribute($value){
        $result = explode(',', $value);
        return $result;
    }

    public function setGamerIdsAttribute($value) {
        $this->attributes['gamer_ids']= join(',', $value);
    }
}
