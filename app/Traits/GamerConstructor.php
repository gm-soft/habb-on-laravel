<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 21.03.2017
 * Time: 10:53
 */

namespace App\Traits;


use App\Helpers\MiscUtils;
use App\Models\Gamer;

/**
 * Class GamerConstructor
 * @package App\Traits
 *
 * Трейт для хранения однотипных операций(функций), связанных с геймерами
 */
trait GamerConstructor
{
    /**
     * Конструирует запись геймера. Без сохранения
     * @param array $input
     * @param null $id
     * @return Gamer
     */
    protected function constructGamerInstance(array $input, $id = null) {
        $gamer              = is_null($id) ? new Gamer : Gamer::find($id);
        $gamer->name        = $input['name'];
        $gamer->last_name   = $input['last_name'];

        $phone = MiscUtils::formatPhone($input['phone']);
        $gamer->phone       = $phone;
        $gamer->email       = $input['email'];

        $gamer->birthday    = MiscUtils::getValueOrDefault($input, 'birthday');
        $gamer->city        = MiscUtils::getValueOrDefault($input, 'city');
        $gamer->vk_page     = MiscUtils::getValueOrDefault($input, 'vk_page');
        $gamer->status      = MiscUtils::getValueOrDefault($input, 'status');
        $gamer->institution = MiscUtils::getValueOrDefault($input, 'institution');
        $gamer->comment     = MiscUtils::getValueOrDefault($input, 'comment');
        $gamer->lead_id     = MiscUtils::getValueOrDefault($input, 'lead_id');

        $gamer->primary_game = MiscUtils::getValueOrDefault($input, 'primary_game');
        $gamer->secondary_games = MiscUtils::getValueOrDefault($input, 'secondary_games');

        return $gamer;
    }

    /**
     * Конструирует запись геймера только с обязательными полями. Без сохранения
     * @param array $input
     * @param null $id
     * @return Gamer
     */
    protected function constructGamerInstanceWithRequiredOnly(array $input, $id = null) {
        $gamer              = is_null($id) ? new Gamer : Gamer::find($id);
        $gamer->name        = $input['name'];
        $gamer->last_name   = $input['last_name'];

        $phone = MiscUtils::formatPhone($input['phone']);
        $gamer->phone       = $phone;
        $gamer->email       = $input['email'];
        $gamer->city        = $input['city'];
        $gamer->vk_page     = $input['vk_page'];

        return $gamer;
    }
}