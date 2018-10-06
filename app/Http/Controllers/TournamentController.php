<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\VarDumper;
use App\Models\Gamer;
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
        $participants = Team::getSelectableOptionArray();
        $games = Constants::getGamesForSelect();
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

        $instance->participant_ids = $participantIds;

        //VarDumper::VarExport(Input::all());
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
        if ($instance->tournament_type == Tournament::Gamer) {
            $participants = Gamer::getSelectableOptionArray();
        } else {
            $participants = Team::getSelectableOptionArray();
        }

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
        } else {
            $scores = null;
            $participantIds = null;
        }
        $instance->participant_scores = $scores;
        $instance->participant_ids = $participantIds;

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
        /** @var Tournament $instance */
        $instance = Tournament::find($id);
        $result = $instance->delete();
        if ($result == true) {
            $message = "Запись ID".$instance->id." удалена из базы";
            $type = Constants::Success;
        } else {
            $message = "Запись ID".$instance->id." не удалена из базы<br>";
            $errors = $instance->errors();
            foreach ($errors as $error) {
                $message .= $error."<br>";
            }
            $type = Constants::Error;
        }
        flash($message, $type);
        return Redirect::action('TournamentController@index');
    }
    #endregion

    public function scoreUpdate(Request $request) {
        // TODO реализовать
        $game = $request->input('game');
        $tournamentId = $request->input('tournament_id');
        $participantId = $request->input('participant_id');
        $scoreValue = intval($request->input('score_value'));
        $withGamers = !is_null($request->input('with_gamers')) ? boolval($request->input('with_gamers')) : false;

        $redirect = Redirect::action('TournamentController@show', ["id" => $tournamentId]);

        if (is_null($game)) {
            flash('Определите игровую дисциплину турнира', Constants::Warning);
            return $redirect;
        }

        /** @var Tournament $tournament */
        $tournament = Tournament::find($tournamentId);
        if ($tournament->tournament_type == Tournament::Gamer) {

            /** @var Gamer $participant */
            $participant = Gamer::find($participantId);
            $participant->addScoreValue($game, $scoreValue);
            $tournament->addScoreValueOfId($participantId, $scoreValue);

        } else {
            /** @var Team $participant */
            $participant = Team::find($participantId);
            $participant->addScoreValue($game, $scoreValue);
            $tournament->addScoreValueOfId($participantId, $scoreValue);
            if ($withGamers) {
                $gamers = $participant->getGamers(false);
                foreach ($gamers as $gamer) {
                    $gamer->addScoreValue($game, $scoreValue);
                }
            }
        }
        $result = $tournament->save();


        if ($result) {
            flash('Очки сохранены', Constants::Success);
            return $redirect;
        }
        flash('Произошла ошибка при сохранении', Constants::Error);
        return $redirect;
    }
}
