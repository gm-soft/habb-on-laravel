<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 21.03.2017
 * Time: 10:53
 */

namespace App\Traits;


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
     * Удаляет специсимволы из телефона
     * @param $phone
     * @return mixed
     */
    protected function formatPhone($phone) {
        $phone = str_replace('-','',$phone);
        $phone = str_replace('(','',$phone);
        $phone = str_replace(')','',$phone);
        return $phone;
    }

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

        $phone = $this->formatPhone($input['phone']);
        $gamer->phone       = $phone;
        $gamer->email       = $input['email'];
        $gamer->birthday    = $input['birthday'];
        $gamer->city        = $input['city'];
        $gamer->vk_page     = $input['vk_page'];
        $gamer->status      = $input['status'];
        $gamer->institution = $input['institution'];
        $gamer->comment     = isset($input['comment']) ? $input['comment'] : null;
        $gamer->lead_id     = isset($input['lead_id']) ? $input['lead_id'] : null;

        $gamer->primary_game = $input['primary_game'];
        $gamer->secondary_games = $input['secondary_games'];

        return $gamer;
    }
}