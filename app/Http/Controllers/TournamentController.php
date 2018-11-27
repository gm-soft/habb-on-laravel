<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\ExcelExporter;
use App\Helpers\FrontDataFiller;
use App\Helpers\MiscUtils;
use App\Helpers\VarDumper;
use App\Models\Banner;
use App\Models\Gamer;
use App\Models\Post;
use App\Models\Team;
use App\Models\Tournament;
use App\ViewModels\Back\SelectOptionItem;
use App\ViewModels\Back\Tournament\TournamentEditViewModel;
use App\ViewModels\Front\TournamentViewModel;
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
        $select_options = [];
        foreach (Banner::all() as $banner){

            $item = new SelectOptionItem;
            $item->id = $banner->id;
            $item->title = $banner->title ?? $banner->id;
            $item->is_selected = false;

            $select_options[] = $item;
        }

        $select_options = collect($select_options)->unique('id')->all();

        $model = new TournamentEditViewModel();
        $model->tournament = null;
        $model->select_options = $select_options;

        return view('admin.tournaments.create', [
            'model' => $model
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
        $instance->encodeHtmlDescription    (Input::get('public_description'));

        $instance->event_date               = MiscUtils::parseLocalDatetime(Input::get('event_date'));
        $instance->registration_deadline    = MiscUtils::parseLocalDatetime(Input::get('registration_deadline'));
        $instance->attached_to_nav          = Input::get('attached_to_nav') == "on";
        $instance->hashtags                 = Input::get('hashtags');

        $instance->created_at               = Carbon::now();
        $instance->updated_at               = $instance->created_at;

        $result = $instance->save();
        if ($result == false) {
            return Redirect::action('TournamentController@create')
                ->withErrors($instance->errors())
                ->withInput(Input::all());
        }

        $instance->banners()->attach(Input::get('banners'));

        return Redirect::action('TournamentController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);
        $instance->decodeHtmlDescription();

        $participants = $instance->teamParticipants;
        $participantsCount = $instance->teamParticipants()->count();

        $guests = $instance->eventGuests;
        $guestsCount = $instance->eventGuests()->count();

        return view('admin.tournaments.show', [
            'instance' => $instance,
            'participants' => $participants,
            'participantsCount' => $participantsCount,
            'guests' => $guests,
            'guestsCount' => $guestsCount
        ]);
    }

    public function export($id){
        /** @var Tournament $instance */
        $instance = Tournament::find($id);

        $participants = $instance->teamParticipants;
        $participantsCount = $instance->teamParticipants()->count();

        return ExcelExporter::createInstance('admin.tournaments.excel',
            ['tournament' => $instance, 'participants' => $participants, 'participantsCount' => $participantsCount],
            "$instance->name.xls")
            ->getResult();
    }

    // TODO MAxim: add a link to this action
    public function exportEventGuests($id) {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);

        $guests = $instance->eventGuests;
        $guestsCount = $instance->eventGuests()->count();

        return ExcelExporter::createInstance('admin.tournaments.guests',
            ['tournament' => $instance, 'guests' => $guests, 'guestsCount' => $guestsCount],
            "$instance->name-guests.xls")
            ->getResult();
    }

    public function edit($id)
    {
        /** @var Tournament $instance */
        $instance = Tournament::find($id);

        $banners = $instance->banners()->get();

        $attached_banners_ids = [];

        foreach ($banners as $banner) {
            $attached_banners_ids[] = $banner->id;
        }

        $select_options = [];
        foreach (Banner::all() as $banner){

            $item = new SelectOptionItem;
            $item->id = $banner->id;
            $item->title = $banner->title ?? $banner->id;
            $item->is_selected = \App\Helpers\MiscUtils::search_array($banner->id, $attached_banners_ids);

            $select_options[] = $item;
        }

        $select_options = collect($select_options)->unique('id')->all();

        $model = new TournamentEditViewModel();
        $instance->event_date = $instance->event_date->setTimezone(MiscUtils::AlmatyLocalTimezone);
        $model->tournament = $instance;
        $model->select_options = $select_options;

        return view('admin.tournaments.edit', [
                'model' => $model
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
        $instance->encodeHtmlDescription    (Input::get('public_description'));
        $instance->attached_to_nav          = Input::get('attached_to_nav') == "on";
        $instance->hashtags                 = Input::get('hashtags');

        $instance->event_date               = MiscUtils::parseLocalDatetime(Input::get('event_date'));
        $instance->registration_deadline    = MiscUtils::parseLocalDatetime(Input::get('registration_deadline'));
        $instance->updated_at               = Carbon::now();

        $result = $instance->save();
        if ($result == false) {
            return Redirect::action('TournamentController@create')
                ->withErrors($instance->errors())
                ->withInput(Input::all());
        }

        $instance->banners()->sync(Input::get('banners'));

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

    public function preview(){

        // СОХРАНЯТЬ НЕ НУЖНО! Напоминание себе и потомкам

        /** @var Tournament $tournament */
        $tournament = new Tournament();

        $tournament->name                   = Input::get('name');
        $tournament->public_description     = Input::get('public_description');
        $tournament->event_date             = MiscUtils::parseLocalDatetime(Input::get('event_date'));
        $tournament->registration_deadline  = MiscUtils::parseLocalDatetime(Input::get('registration_deadline'));
        $tournament->hashtags               = Input::get('hashtags');
        $tournament->created_at             = Carbon::now();
        $tournament->updated_at             = Carbon::now();

        $topNews = Post::searchByHashtags($tournament->getHashtagsAsArray(), 3);

        $model = new TournamentViewModel();
        $model->tournament = $tournament;
        $model->topNews = $topNews;

        $model->banners = Banner::find(Input::get('banners'));
        $model->banners_count = count($model->banners);

        $model->showRegisterButton = $tournament->event_date->gt(MiscUtils::getLocalDatetimeNow());

        $model->eventDateString = $tournament->EventDate();

        FrontDataFiller::create($model)->fill();

        return view('front.tournaments.show', ["model" => $model]);
    }
}
