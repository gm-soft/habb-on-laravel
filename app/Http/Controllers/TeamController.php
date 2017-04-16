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
        $gamers = [];
        foreach ($instances as $instance){
            $gamers[$instance->name] = $instance->getGamers();
        }
        return view('admin/teams/index', [
            "teams" => $instances,
            'gamers' => $gamers
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
        $scores = TeamScore::getScoreSet();
        $instance->scores()->saveMany($scores);

        return Redirect::action('TeamController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamers = $instance->getGamers();
        return view('admin.teams.show', [
            'team' => $instance,
            'scores' => $instance->scores,
            'gamers' => $gamers
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

    public function scoreUpdate(Request $request)
    {
        /** @var Team $instance */
        $id = Input::get('team_id');
        $instance = Team::with('scores')->find($id);
        $gameName = Input::get('game_name');
        $scoreValue = Input::get('score_value');

        if (is_null($gameName) || is_null($scoreValue)) {
            Log::info("Прислан невалидный реквест на обновление очков команды");

            flash("Название игры или очки пустые", Constants::Error);
            return Redirect::action('GamerController@show', ["id" => $id]);
        }


        $result = $instance->addScoreValue($gameName, $scoreValue);
        if (!is_null(Input::get('with_gamers'))) {
            $gamers = $instance->getGamers(false);
            foreach ($gamers as $gamer) {
                $result = $result && $gamer->addScoreValue($gameName, $scoreValue);
            }
        }

        if ($result == false) {

            $message = "Не найдена запись очков игрока<br>";
            $message .= join('<br>', $instance->errors());
            flash($message, Constants::Error);
            return Redirect::action('TeamController@show', ["id" => $id]);
        }
        flash("Очки обновлены", Constants::Success);
        return Redirect::action('TeamController@show', ["id" => $id]);

    }

    public function destroy($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);
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
