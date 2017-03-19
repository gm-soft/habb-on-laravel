<?php

namespace App\Http\Controllers;

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
        // TODO Убрать. Тест
        $currentParticipants = [Team::find(1)];
        return view('admin.tournaments.create', ['participants' => $participants, 'currentParticipants' => $currentParticipants]);
    }

    public function store(Request $request)
    {
        // TODO реализовать

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
        $instance->participant_max_count    = Input::get('participant_max_count');

        $instance->started_at               = Input::get('started_at');
        $instance->reg_closed_at            = Input::get('reg_closed_at');

        $participantIds = Input::get('participant_ids');

        if (is_null($participantIds)) {
            $instance->participant_ids = $participantIds;
            $instance->participant_scores = [];

            for($i = 0; $i < count($participantIds); $i++) {
                $instance->participant_scores[] = 0;
            }
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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    #endregion
}
