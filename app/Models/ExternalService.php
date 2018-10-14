<?php

namespace App\Models;

use App\Traits\TimestampModelTrait;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

/**
 * Class ExternalService
 * @package App\Models
 *
 * @property int id
 * @property string title Название сервиса или сайта
 * @property string comment Комментарий модератора
 * @property string api_key Уникальный идентификатор
 *
 * @property Gamer[] gamers
 *
 * @property Carbon updated_at
 * @property Carbon created_at
 * @property Carbon deleted_at
 *
 */
class ExternalService extends Ardent
{
    use FormAccessible, SoftDeletes, TimestampModelTrait;

    public static $rules = [
        'title'      => 'required',
        'api_key'     => 'required|unique:external_services'
    ];

    protected $table = "external_services";

    protected $fillable = array(
        'name', 'comment', 'api_key'
    );

    protected $dates = [
        'deleted_at'
    ];

    public static $relationsData = [
        'gamers' => [self::HAS_MANY, 'Gamer']
    ];

    /**
     * Созданные игроки внешним сервисом Gamer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamers()
    {
        $gamers = $this->hasMany('App\Models\Gamer');
        return $gamers;
    }

    /**
     * @param $apiKey
     * @return ExternalService|\Illuminate\Database\Eloquent\Model|null
     */
    public static function findByApiKey($apiKey) {
        return (new ExternalService)->where('api_key', '=', $apiKey)->first();
    }
}
