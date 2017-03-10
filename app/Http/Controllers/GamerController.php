<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Gamer;
use App\Models\GamerScore;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Log;
use Redirect;
use Validator;

class GamerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $gamers = Gamer::all();
        return $this->View('admin/gamers/index', ["gamers" => $gamers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function create()
    {
        $userAgent = request()->header('User-Agent');
        $isIosDevice = stripos($userAgent,"iPod")||stripos($userAgent,"iPhone")||stripos($userAgent,"iPad");

        return $this->View('admin.gamers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        $validator = Validator::make($input, Gamer::rules());

        if ($validator->fails()) {
            return Redirect::action('GamerController@create')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        $gamer = new Gamer;
        $gamer->name = Input::get('name');
        $gamer->last_name = Input::get('last_name');

        $gamer->phone = Input::get('phone');
        $gamer->email = Input::get('email');
        $gamer->birthday = Input::get('birthday');
        $gamer->city = Input::get('city');
        $gamer->vk_page = Input::get('vk_page');
        $gamer->status = Input::get('status');
        $gamer->institution = Input::get('institution');
        $gamer->comment = Input::get('comment');
        $gamer->lead_id = Input::get('lead_id');

        $gamer->primary_game = Input::get('primary_game');
        $gamer->secondary_games = Input::get('secondary_games');

        $success = $gamer->save();
        if ($success == false) {
            return Redirect::action('GamerController@create')
                ->withErrors($gamer->errors())
                ->withInput($input);

        }
        $scores = GamerScore::getScoreSet();
        $gamer->scores()->saveMany($scores);

        return Redirect::action('GamerController@show', ["id" => $gamer->id])
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
        /** @var Gamer $gamer */
        $gamer = Gamer::find($id);
        return $this->View('admin.gamers.show', [
            'gamer' => $gamer,
            'scores' => $gamer->scores()
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
        /** @var Gamer $gamer */
        $gamer = Gamer::find($id);
        return $this->View('admin.gamers.edit', [
            'gamer' => $gamer,
            'scores' => $gamer->scores()
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
        $validator = Validator::make($input, Gamer::rules($id));

        if ($validator->fails()) {
            return Redirect::action('GamerController@edit', ["id" => $id])
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        /** @var Gamer $gamer */
        $gamer = Gamer::find($id);
        $gamer->name = Input::get('name');
        $gamer->last_name = Input::get('last_name');

        $gamer->phone = Input::get('phone');
        $gamer->email = Input::get('email');
        $gamer->birthday = Input::get('birthday');
        $gamer->city = Input::get('city');
        $gamer->vk_page = Input::get('vk_page');
        $gamer->status = Input::get('status');
        $gamer->institution = Input::get('institution');
        $gamer->comment = Input::get('comment');
        $gamer->lead_id = Input::get('lead_id');
        $gamer->primary_game = Input::get('primary_game');
        $gamer->secondary_games = Input::get('secondary_games');

        $res = $gamer->update();

        if ($res === false) {
            return Redirect::action('GamerController@edit', ["id" => $gamer->id])
                ->withErrors($gamer->errors())
                ->withInput($input);
        }
        return Redirect::action('GamerController@show', ["id" => $gamer->id])
            ->with('success', 'Данные сохранены');
    }

    /**
     * Обновляет очки геймера
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function scoreUpdate(Request $request)
    {
        /** @var Gamer $gamer */
        $id = Input::get('gamer_id');
        $gamer = Gamer::with('scores')->find($id);
        $gameName = Input::get('game_name');
        $scoreValue = Input::get('score_value');

        if (is_null($gameName) || is_null($scoreValue)) {
            Log::info("Прислан невалидный реквест на обновление очков команды");

            flash("Название игры или очки пустые", Constants::Error);
            return Redirect::action('GamerController@show', ["id" => $id]);
        }


        $result = $gamer->addScoreValue($gameName, $scoreValue);
        if ($result == false) {

            $message = "Не найдена запись очков игрока<br>";
            $message .= join('<br>', $gamer->errors());
            flash($message, Constants::Error);
            return Redirect::action('GamerController@show', ["id" => $id]);
        }
        flash("Очки обновлены", Constants::Success);
        return Redirect::action('GamerController@show', ["id" => $id]);

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
