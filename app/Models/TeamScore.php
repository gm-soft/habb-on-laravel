<?php

namespace App\Models;


use App\Helpers\Constants;
use App\Interfaces\IScoreInstance;
use LaravelArdent\Ardent\Ardent;

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
