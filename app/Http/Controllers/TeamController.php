<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\Constants;
use App\Traits\TeamConstructor;
use App\Models\Gamer;
use App\Models\Team;
use App\Models\TeamScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;
use Redirect;
use Validator;

class TeamController extends Controller
{
    use TeamConstructor;

    public function index()
    {
        /** @var Team[] $instances */
        $instances = Team::all();

        return view('admin.teams.index', [
            "teams" => $instances,
        ]);
    }

    public function create()
    {
        $gamerOptionList = Gamer::getSelectableOptionArray();
        return view('admin.teams.create', ['gamerOptionList' => $gamerOptionList]);
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamController@create')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        $instance = $this->constructTeamFromInput(null, Input::all());

        $success = $instance->save();
        if ($success == false) {
            return Redirect::action('TeamController@create')
                ->withErrors($instance->errors())
                ->withInput($input);

        }

        return Redirect::action('TeamController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);

        return view('admin.teams.show', [
            'team' => $instance,
        ]);
    }

    public function edit($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamerOptionList = Gamer::getSelectableOptionArray();

        return view('admin.teams.edit', [
            'team' => $instance,
            'gamerOptionList' => $gamerOptionList
        ]);
    }


    public function update(Request $request, $id)
    {

        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }
        $instance = $this->constructTeamFromInput($id, Input::all());
        $res = $instance->update();

        if ($res === false) {
            return Redirect::action('TeamController@edit', ["id" => $instance->id])
                ->withErrors($instance->errors())
                ->withInput($input);
        }
        return Redirect::action('TeamController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);

        $instance->tournamentsThatTakePart()->sync([]);

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
        return Redirect::action('TeamController@index');
    }


}
