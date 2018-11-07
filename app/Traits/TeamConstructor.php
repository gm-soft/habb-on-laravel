<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 14.03.2017
 * Time: 20:28
 */

namespace App\Traits;


use App\Models\Gamer;
use App\Models\Team;
use App\Models\TeamCreateRequest;
use App\Models\TeamScore;

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

        /** @var Team $instance */
        $instance = !is_null($id) ? Team::find($id) : new Team();
        $instance->name = $input['name'];
        $instance->comment = isset($input['comment']) ? $input['comment'] : null;
        $instance->city = $input['city'];

        $instance->captain_gamer_id = $this->getValueOrNull($input['captain_gamer_id']);
        $instance->second_gamer_id  = $this->getValueOrNull($input['second_gamer_id']);
        $instance->third_gamer_id   = $this->getValueOrNull($input['third_gamer_id']);
        $instance->forth_gamer_id   = $this->getValueOrNull($input['forth_gamer_id']);
        $instance->fifth_gamer_id   = $this->getValueOrNull($input['fifth_gamer_id']);
        $instance->optional_gamer_id = $this->getValueOrNull($input['optional_gamer_id']);

        return $instance;
    }

    private function getValueOrNull($value){
        return isset($value) && $value !== "null" ? $value : null;
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

    /**
     * Конструирует команду из заявки. Без создания TeamScore.
     * @param TeamCreateRequest $teamCreateRequest
     * @return Team
     */
    protected function createTeamFromCreateRequest(TeamCreateRequest $teamCreateRequest) {
        $team = new Team();
        $team->name = $teamCreateRequest->name;
        $team->city = $teamCreateRequest->city;
        $team->comment = "Создана из заявки #".$teamCreateRequest->id;
        $gamer_ids = [];
        $gamer_roles = [];

        for ($i = 0; $i < count($teamCreateRequest->participant_ids);$i++) {
            $participantId = $teamCreateRequest->participant_ids[$i];
            $role = $teamCreateRequest->participant_roles[$i];
            /** @var Gamer|null $gamer */
            $gamer = Gamer::find($participantId);

            if ($gamer) {
                $gamer_ids[] = $gamer->id;
                $gamer_roles[] = $role;
            }
        }
        $team->gamer_ids = $gamer_ids;
        $team->gamer_roles = $gamer_roles;
        return $team;
    }
}
