<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\TeamCreateRequest;
use App\Traits\TeamConstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class TeamCreateRequestController extends Controller
{
    use TeamConstructor;

    public function index(Request $request)
    {
        $instances = TeamCreateRequest::all();

        //$instances = $instances->where('deleted_at', '=', null);
        return view('admin.teamRequests.index', [
            "instances" => $instances,
        ]);
    }


    public function create()
    {
        $cities = Constants::getCities();
        return view('admin.teams.create',
            ['cities' => $cities]
        );
    }

    public function store(Request $request)
    {
        // TODO Копипаста

        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamCreateRequestController@create')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        $instance = $this->constructTeamCreateRequest(null, Input::all());

        $success = $instance->save();
        if ($success == false) {
            return Redirect::action('TeamCreateRequestController@create')
                ->withErrors($instance->errors())
                ->withInput($input);

        }

        return Redirect::action('TeamCreateRequestController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        // TODO Копипаста
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamers = $instance->getGamers();
        return $this->View('admin.teams.show', [
            'team' => $instance,
            'scores' => $instance->scores(),
            'gamers' => $gamers
        ]);
    }

    public function edit($id)
    {
        // TODO Копипаста
        /** @var Team $instance */
        $instance = Team::find($id);
        $gamerOptionList = Gamer::asSelectableOptionArray();

        return $this->View('admin.teams.edit', [
            'team' => $instance,
            'gamerOptionList' => $gamerOptionList
        ]);
    }

    public function update(Request $request, $id)
    {
        // TODO Копипаста
        $input = $request->input();
        $validator = Validator::make($input, Team::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamCreateRequestController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }
        $instance = $this->constructTeamFromInput($id, Input::all());
        $res = $instance->update();

        if ($res === false) {
            return Redirect::action('TeamCreateRequestController@edit', ["id" => $instance->id])
                ->withErrors($instance->errors())
                ->withInput($input);
        }
        return Redirect::action('TeamCreateRequestController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id)
    {
        // TODO Копипаста
        // TODO: Реализовать удаление. Да и вообще нужно и во вьюхах поредактировать. DELETE походу отправляется запрос
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
        return Redirect::action('TeamCreateRequestController@index');
    }
}
