<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamCreateRequest;
use App\Traits\EmailSender;
use DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use EmailSender;

    public function test() {

        /** @var Team $team */
        $team = Team::find(51);
        /** @var TeamCreateRequest $teamCreateRequest */
        $teamCreateRequest = TeamCreateRequest::find(1);
        $gamers = $team->getGamers();

        $viewString = view('mails.team-create-confirmed', ['request'=>$teamCreateRequest, 'team'=>$team, 'gamers'=>$gamers])->render();

        $to = $teamCreateRequest->requester_email;
        $subject = "Утверждение заявки";
        $res = $this->sendEmail($subject, $viewString, $to);

        echo $res;
        die();
    }

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
            $inserts[] = [
                'id' => $item->id,
                'name' => $item->name,
                'last_name' => $item->last_name,
                'phone' => $item->phone,
                'email' => $item->email,
                'birthday' => $item->birthday,
                'city' => $item->city,
                'vk_page' => $item->vk_page,
                'status' => $status,
                'institution' => $inst,
                'comment' => $item->comment,
                'lead_id' => $item->lead_id,
                'secondary_games' => $item->secondary_games,
                'primary_game' => $item->primary_game,
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
                'total_change' => $item->total_change,
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
                'comment' => !is_null($item->comment) || $item->comment == '' ? $item->comment : 'no comment',

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
                'total_change' => $item->total_change,
                'month_value' => $item->month_value,

            ];
            $scoreCount++;
        }
        DB::table('team_scores')->insert($inserts);


        return response()->json(['count' => $count, 'scoreCount' => $scoreCount]);
    }
}
