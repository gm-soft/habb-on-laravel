<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\VarDumper;
use App\Models\Gamer;
use App\Models\Team;
use App\Models\Tournament;
use Carbon\Carbon;
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
        return view('admin.tournaments.create');
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

        $instance->started_at               = Input::get('started_at');
        $instance->reg_closed_at            = Input::get('reg_closed_at');
        $instance->created_at               = Carbon::now();
        $instance->updated_at               = $instance->created_at;

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

        return view('admin.tournaments.show', [
            'instance' => $instance
        ]);
    }

    public function edit($id)
    {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);

        return view('admin.tournaments.edit', [
                'instance' => $instance
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

        $instance->started_at               = Input::get('started_at');
        $instance->reg_closed_at            = Input::get('reg_closed_at');
        $instance->updated_at               = Carbon::now();

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
}
