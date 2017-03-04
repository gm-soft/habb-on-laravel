<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use LaravelArdent\Ardent\Facades\Ardent;

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
 * @property GamerScore score
 */
class Gamer extends Ardent
{
    public static $rules = array(
        'name'      => 'required',
        'last_name' => 'required',
        'email'     => 'required|between:5,100|email|unique:gamers',
        'phone'     => 'required|unique:gamers',
    );
    protected $table = "gamers";
    protected $attributes = array(

        'city' => 'Астана',
        'status' => 'dumbass',
        'institution' => '-',
        'comment' => 'Комментарий отсутствует'
    );
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
}
