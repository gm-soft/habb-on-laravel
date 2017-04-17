<?php

namespace App\Http\Controllers;

use App\Helpers\VarDumper;
use App\Interfaces\ISelectableOption;
use App\Models\Gamer;
use App\Models\Team;
use App\Models\TeamCreateRequest;
use App\Models\Tournament;
use App\Traits\EmailSender;
use DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    /**
     * route participantsForSelect
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParticipantsForSelect(Request $request){
        $type = $request->input('type');
        if (is_null($type)) {

            return \Response::json([
                'result' => false,
                'error' => 'type is empty'
            ], 404);
        }

        /** @var ISelectableOption[] $instances */
        if ($type == Tournament::Gamer) {
            $instances = Gamer::getSelectableOptionArray(false);
        } else {
            $instances = Team::getSelectableOptionArray(false);
        }

        //VarDumper::VarExport($instances);
        $result = [];
        foreach ($instances as $key => $value) {
            $item = [
                'id' => $key,
                'text' => $value
            ];
            $result[] = $item;
        }

        return \Response::json($result);
    }


    use EmailSender;

    public function test() {

        /** @var Team $team */
        $team = Team::find(51);
        /** @var TeamCreateRequest $teamCreateRequest */
        $teamCreateRequest = TeamCreateRequest::find(1);
        $gamers = $team->getGamers();

        $viewString = view('mails.team-create-confirmed', [
            'request'=>$teamCreateRequest, 'team'=>$team, 'gamers'=>$gamers
        ])->render();

        $to = $teamCreateRequest->requester_email;
        $subject = "Утверждение заявки";
        $res = $this->sendEmail($subject, $viewString, $to);

        echo $res;
        die();
    }

    #region Sync TODO need to be released
    public function syncGamers() {

        $oldGamers = DB::table('gamers_old')->get()->all();
        $oldGamerScores = DB::table('gamer_scores_old')->get()->all();

        $count = 0;
        $scoreCount = 0;
        $inserts = [];
        for($i = 0; $i < count($oldGamers); $i++) {

            $item = $oldGamers[$i];
            $status = !is_null($item->status) ? $item->status : "dumbass";
            $inst = !is_null($item->status) ? $item->institution : "-";
            $prim_game = strtolower($item->primary_game);
            $sec_games = strtolower($item->secondary_games);
            $inserts[] = [
                'id' => $item->id,
                'name' => $item->name,
                'last_name' => $item->last_name,
                'phone' => $item->phone,
                'email' => $item->email,
                'birthday' => $item->birthday,
                'city' => $item->city,
                'vk_page' => $item->vk,
                'status' => $status,
                'institution' => $inst,
                'comment' => $item->comment,
                'lead_id' => $item->lead_id,
                'secondary_games' => $sec_games,
                'primary_game' => $prim_game,
            ];
            $count++;
        }
        DB::table('gamers')->insert($inserts);
        //------------------
        $inserts = [];
        foreach ($oldGamerScores as $item) {
            $inserts[] = [
                'id' => $item->id,
                'gamer_id' => $item->gamer_id,
                'game_name' => $item->game_name,
                'total_value' => $item->total_value,
                'total_change' => $item->change_total,
                'month_value' => $item->month_value,

            ];
            $scoreCount++;
        }
        DB::table('gamer_scores')->insert($inserts);


        return response()->json(['count' => $count, 'scoreCount' => $scoreCount]);
    }

    public function syncTeams() {
        $oldGamers = DB::table('teams_old')->get()->all();
        $oldGamerScores = DB::table('team_scores_old')->get()->all();

        $count = 0;
        $scoreCount = 0;
        $inserts = [];
        for($i = 0; $i < count($oldGamers); $i++) {

            $item = $oldGamers[$i];

            $gamer_ids = [];
            $gamer_roles = [];

            $gamer_ids[0] = $item->captain_id;
            $gamer_roles[0] = 'captain';

            $gamers = [$item->player_2_id, $item->player_3_id,$item->player_4_id,$item->player_5_id];
            foreach ($gamers as $gamer) {
                if (is_null($gamer)) continue;
                $gamer_ids[] = $gamer;
                $gamer_roles[] = 'gamer';
            }

            $inserts[] = [
                'id' => $item->id,
                'name' => $item->name,
                'city' => $item->city,
                'comment' => !is_null($item->comment) || $item->comment == '' ? $item->comment : '-',

                'gamer_ids' => join(', ', $gamer_ids),
                'gamer_roles' => join(', ', $gamer_roles),

                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
            $count++;
        }
        DB::table('teams')->insert($inserts);
        //------------------
        $inserts = [];
        foreach ($oldGamerScores as $item) {
            $inserts[] = [
                'id' => $item->id,
                'team_id' => $item->team_id,
                'game_name' => $item->game_name,
                'total_value' => $item->total_value,
                'total_change' => $item->change_total,
                'month_value' => $item->month_value,

            ];
            $scoreCount++;
        }
        DB::table('team_scores')->insert($inserts);


        return response()->json(['count' => $count, 'scoreCount' => $scoreCount]);
    }
    #endregion
}
