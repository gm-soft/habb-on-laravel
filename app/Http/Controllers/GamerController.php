<?php

namespace App\Http\Controllers;

use App\Models\Gamer;
use App\Models\GamerScore;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;

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

        return $this->View('admin/gamers/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamer = Gamer::create(
            $request->input()
        );

        $success = $gamer->save();
        if ($success == false) {
            $errors = $gamer->errors()->all();

        }
        $score = new GamerScore([
            'game_name' => 'cs:go'
        ]);
        $gamer->scores()->save($score);


        return response()->redirectTo('/admin/gamers/'.$gamer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $gamer = Gamer::find($id);

        return $this->View('admin/gamers/show', [
            'gamer' => $gamer,
            'scores' => $gamer->scores
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
        $gamer = Gamer::find($id);
        return $this->View('admin/gamers/edit', [
            'gamer' => $gamer,
            'scores' => $gamer->scores
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
        // TODO проверить код на ошибки. Копипастнул
        // http://stackoverflow.com/questions/21314130/laravel-ardent-user-model-editing-saving
        $input = Input::all();
        $gamer = new Gamer($input);
        if($gamer->validate(Gamer::$rules)) {

            // get user from database and fill with input except password
            $gamer = User::find($id);

            if($gamer->save())
                return Redirect::action('GamerController@show', ["id" => $id])
                    ->with('success', 'Данные сохранены');
        }

        return Redirect::action('GamerController@edit', $id)
            ->with('error', 'Возникли некоторые ошибки при валидации')
            ->withErrors($gamer->errors());
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
