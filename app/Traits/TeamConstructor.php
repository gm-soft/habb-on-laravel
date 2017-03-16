<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 14.03.2017
 * Time: 20:28
 */

namespace App\Traits;


use App\Models\Team;
use App\Models\TeamCreateRequest;

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


    /**
     * Конструирует заявку на команду
     * @param null $id
     * @param array $input
     * @return TeamCreateRequest
     */
    protected function constructTeamCreateRequest($id = null, array $input) {

        /** @var TeamCreateRequest $instance */
        $instance = !is_null($id) ? TeamCreateRequest::find($id) : new TeamCreateRequest();
        $instance->name = $input['name'];
        $instance->city = $input['city'];

        $instance->requester_name = $input['requester_name'];
        $instance->requester_phone = $input['requester_phone'];
        $instance->requester_email = $input['requester_email'];
        $instance->requester_comment = isset($input['requester_email']) ? $input['requester_email'] : null;

        $instance->request_processed = isset($input['request_processed']) ? $input['request_processed'] : false;
        $instance->team_created = isset($input['team_created']) ? $input['team_created'] : false;
        $instance->team_id = isset($input['team_id']) ? $input['team_id'] : null;
        $instance->comment = isset($input['comment']) ? $input['comment'] : null;

        if (!isset($input['participant_roles'])) {
            $input['participant_roles'] = [
                'captain','gamer', 'gamer','gamer','gamer'
            ];
        }
        $instance->participant_ids = $input['participant_ids'];
        $instance->participant_names = $input['participant_names'];
        $instance->participant_roles = $input['participant_roles'];

        return $instance;

    }
}
