<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Gamer;
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
        $phoneRegPattern = Constants::PhoneRegexPattern;
        $emailRegPattern = Constants::EmailRegexPattern;
        return view('admin.teamRequests.create',
            ['phoneRegPattern' => $phoneRegPattern, 'emailRegPattern' => $emailRegPattern]
        );
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, TeamCreateRequest::$rules);

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

        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);

        $gamers = [];

        for ($i = 0; $i < count($instance->participant_ids); $i++) {

            $participant_id = $instance->participant_ids[$i];
            $gamer = Gamer::find($participant_id);
            $gamers[$i] = $gamer ?? null;
        }
        return $this->View('admin.teamRequests.show', [
            'instance' => $instance, 'gamers' => $gamers
        ]);
    }

    public function edit($id)
    {

        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);
        $phoneRegPattern = Constants::PhoneRegexPattern;
        $emailRegPattern = Constants::EmailRegexPattern;

        return $this->View('admin.teamRequests.edit', [
            'instance' => $instance,'phoneRegPattern' => $phoneRegPattern, 'emailRegPattern' => $emailRegPattern
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $validator = Validator::make($input, TeamCreateRequest::$rules);

        if ($validator->fails()) {
            return Redirect::action('TeamCreateRequestController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }
        $instance = $this->constructTeamCreateRequest($id, Input::all());
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
        /** @var TeamCreateRequest $instance */
        $instance = TeamCreateRequest::find($id);
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
