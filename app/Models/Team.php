<?php

namespace App\Models;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use LaravelArdent\Ardent\Ardent;

/**
 * Class Team
 * Команда игроков
 * @package App\Models
 *
 * @property int id
 * @property string name
 * @property string city
 * @property array gamer_ids
 *
 * @property Carbon updated_at
 * @property Carbon created_at
 */
class Team extends Ardent
{
    use FormAccessible;

    protected $table = "teams";
    protected $casts = [
        'gamer_ids' => 'array',
    ];

    /**
     * @return Gamer[] gamers
     */
    public function getGamers(){

        $result = [];
        foreach ($this->gamer_ids as $gamer_id) {
            /** @var Gamer $gamer */
            $gamer = Gamer::find($gamer_id);
            $result[] = $gamer;
        }
        return $result;
    }
}
