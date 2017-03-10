<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function sync() {

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
}
