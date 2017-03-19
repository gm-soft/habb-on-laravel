<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class TournamentController extends Controller
{
    #region CRUD
    public function index()
    {
        $instances = Tournament::all();
        return view('admin.tournaments.index', [
            "instances" => $instances,
        ]);
    }

    public function create()
    {
        $participants = Team::asSelectableOptionArray();
        $games = Constants::getGameArray();
        return view('admin.tournaments.create', [
            'participants' => $participants,
            'games' => $games
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), Tournament::$rules);
        if ($validator->fails()) {
            return Redirect::action('TournamentController@create')
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }

        $instance                           = new Tournament();
        $instance->name                     = Input::get('name');
        $instance->comment                  = Input::get('comment');
        $instance->public_description       = Input::get('public_description');
        $instance->tournament_type          = Input::get('tournament_type');
        $instance->game                     = Input::get('game');
        $instance->participant_max_count    = Input::get('participant_max_count');

        $instance->started_at               = Input::get('started_at');
        $instance->reg_closed_at            = Input::get('reg_closed_at');

        $participantIds = Input::get('participant_ids');

        if (!is_null($participantIds)) {
            $instance->participant_ids = $participantIds;
            $scores = [];

            for($i = 0; $i < count($participantIds); $i++) {
                $scores[] = 0;
            }

            $instance->participant_scores = $scores;
        } else {
            $instance->participant_ids = null;
            $instance->participant_scores = null;
        }

        $result = $instance->save();
        if ($result == false) {
            return Redirect::action('TournamentController@create')
                ->withErrors($instance->errors())
                ->withInput(Input::all());
        }
        return Redirect::action('TournamentController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);
        $participants = $instance->getParticipants();

        return view('admin.tournaments.show', [
            'instance' => $instance,
            'participants' => $participants
        ]);
    }

    public function edit($id)
    {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);
        $participants = Team::asSelectableOptionArray();
        $current_participants = $instance->getParticipants();
        $games = Constants::getGamesForSelect();

        return view('admin.tournaments.edit', [
                'instance' => $instance,
            'participants'=>$participants,
            'current_participants' => $current_participants,
            'games' => $games
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::all(), Tournament::$rules);
        if ($validator->fails()) {
            return Redirect::action('TournamentController@create')
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }
        /** @var Tournament $instance */
        $instance                           = Tournament::find($id);
        $instance->name                     = Input::get('name');
        $instance->comment                  = Input::get('comment');
        $instance->public_description       = Input::get('public_description');
        $instance->tournament_type          = Input::get('tournament_type');
        $instance->game                     = Input::get('game');
        $instance->participant_max_count    = Input::get('participant_max_count');

        $instance->started_at               = Input::get('started_at');
        $instance->reg_closed_at            = Input::get('reg_closed_at');

        $participantIds = Input::get('participant_ids');

        if (!is_null($participantIds)) {
            $scores = [];

            for($i = 0; $i < count($participantIds); $i++) {

                $scores[] = $instance->getScoreValueOfId($participantIds[$i]);
            }

            $instance->participant_scores = $scores;
            $instance->participant_ids = $participantIds;
        } else {
            $instance->participant_ids = null;
            $instance->participant_scores = null;
        }

        $result = $instance->save();
        if ($result == false) {
            return Redirect::action('TournamentController@create')
                ->withErrors($instance->errors())
                ->withInput(Input::all());
        }
        return Redirect::action('TournamentController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id)
    {
        //
    }
    #endregion

    public function scoreUpdate(Request $request) {
        // TODO реализовать
    }
}
