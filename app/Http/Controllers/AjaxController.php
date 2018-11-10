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
        $instances = Team::getSelectableOptionArray(false);

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
}
