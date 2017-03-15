<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 14.03.2017
 * Time: 20:28
 */

namespace App\Traits;


use App\Models\Team;

trait TeamConstructor
{
    /**
     * Конструирует команду из массива присланных данных с формы.
     * Нужны поля name, city, comment, а также массивы айдишников участников и их роли: gamer_ids и gamer_roles
     * По дефолту первый участник становится капитаном, если ролями не определено иное. Если капитан указан не первым,
     * То он будет помещен на первое место
     *
     * Если $id равен null, то будет создана команда. Иначе - отредактирована существующая.
     * Метод возвращает Тиму, которую можно уже сохранить в базу
     * @param null $id
     * @param array $input
     * @return Team
     */
    protected function constructTeamFromInput($id = null, array $input) {
        $gamerIds = [];
        $gamerRoles = [];
        $gamerIdsSource = $input['gamer_ids'];
        $gamerRolesSource = $input['gamer_roles'];

        for ($i = 0; $i < count($gamerIdsSource); $i++) {

            if ($gamerIdsSource[$i] == 'null') continue;
            $gamerIds[] = $gamerIdsSource[$i];
            $gamerRoles[] = $gamerRolesSource[$i];
        }

        for ($i = 0; $i < count($gamerRoles); $i++) {

            if ($gamerRoles[$i] != 'captain') continue;
            if ($i == 0) continue;

            $tmp = $gamerIds[0];
            $gamerIds[0] = $gamerIds[$i];
            $gamerIds[$i] = $tmp;
            //----
            $tmp = $gamerRoles[0];
            $gamerRoles[0] = $gamerRoles[$i];
            $gamerRoles[$i] = $tmp;
            break;
        }
        /** @var Team $instance */
        $instance = !is_null($id) ? Team::find($id) : new Team();
        $instance->name = $input['name'];
        $instance->comment = $input['comment'];
        $instance->city = $input['city'];
        $instance->gamer_ids = $gamerIds;
        $instance->gamer_roles = $gamerRoles;

        return $instance;
    }


    protected function constructTeamCreateRequest($id = null, array $input) {

    }
}