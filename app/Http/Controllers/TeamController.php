<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
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
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $instances = Team::all();
        return $this->View('admin/teams/index', ["teams" => $instances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function create()
    {
        $gamerOptionList = Gamer::asSelectableOptionArray();
        return view('admin.teams.create', ['gamerOptionList' => $gamerOptionList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO Нужно доработать контроллер, так как вообще не смотрел

        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamController@create')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        $instance = new Team();
        $instance->name = Input::get('name');
        $instance->comment = Input::get('comment');
        $instance->city = Input::get('city');
        $instance->gamer_ids = Input::get('gamer_ids');

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamers = $instance->getGamers();
        return $this->View('admin.teams.show', [
            'team' => $instance,
            'scores' => $instance->scores(),
            'gamers' => $gamers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamerOptionList = Gamer::asSelectableOptionArray();

        return $this->View('admin.teams.edit', [
            'team' => $instance,
            'gamerOptionList' => $gamerOptionList
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        /** @var Team $instance */

        $gamerIds = [];
        $gamerIdsSource = Input::get('gamer_ids');

        for ($i = 0; $i < count($gamerIdsSource); $i++) {
            if ($gamerIdsSource[$i] == 'null') continue;
            $gamerIds[] = $gamerIdsSource[$i];
        }

        $gamerRolesSource = Input::get('gamer_roles');
        for ($i = 0; $i < count($gamerIdsSource); $i++) {

            if ($gamerRolesSource[$i] != 'captain') continue;
            if ($i == 0) continue;

            $tmp = $gamerIds[0];
            $gamerIds[0] = $gamerIds[$i];
            $gamerIds[$i] = $tmp;
            break;
        }

        $instance = Team::find($id);
        $instance->name = Input::get('name');
        $instance->comment = Input::get('comment');
        $instance->city = Input::get('city');
        $instance->gamer_ids = $gamerIds;

        $res = $instance->update();

        if ($res === false) {
            return Redirect::action('TeamController@edit', ["id" => $instance->id])
                ->withErrors($instance->errors())
                ->withInput($input);
        }
        return Redirect::action('TeamController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    /**
     * Обновляет очки команды
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
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
        if ($result == false) {

            $message = "Не найдена запись очков игрока<br>";
            $message .= join('<br>', $instance->errors());
            flash($message, Constants::Error);
            return Redirect::action('TeamController@show', ["id" => $id]);
        }
        flash("Очки обновлены", Constants::Success);
        return Redirect::action('TeamController@show', ["id" => $id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
