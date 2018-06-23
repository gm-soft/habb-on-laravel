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

        $gamer->birthday    = $this->getValueOrDefault($input, 'birthday');
        $gamer->city        = $this->getValueOrDefault($input, 'city');
        $gamer->vk_page     = $this->getValueOrDefault($input, 'vk_page');
        $gamer->status      = $this->getValueOrDefault($input, 'status');
        $gamer->institution = $this->getValueOrDefault($input, 'institution');
        $gamer->comment     = $this->getValueOrDefault($input, 'comment');
        $gamer->lead_id     = $this->getValueOrDefault($input, 'lead_id');

        $gamer->primary_game = $this->getValueOrDefault($input, 'primary_game');
        $gamer->secondary_games = $this->getValueOrDefault($input, 'secondary_games');

        return $gamer;
    }

    /**
     * @param array $input
     * @param string $key
     * @param mixed|null $defaultValue
     * @return mixed|null
     */
    private function getValueOrDefault(array $input, $key, $defaultValue = null){
        return isset($input[$key]) ? $input[$key] : $defaultValue;
    }
}