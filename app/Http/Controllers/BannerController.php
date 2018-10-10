<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Banner;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class BannerController extends Controller
{
    public function index(Request $request){

        $banners = Banner::all();
        return view('admin.banners.index', [
            'banners' => $banners,
            'banners_count' => count($banners)
        ]);
    }

    public function show($id){

        $banner = Banner::find($id);
        return view('admin.banners.show', ['banner' => $banner]);
    }

    public function create(Request $request){

        $available_tournaments = Tournament::all();
        return view('admin.banners.create', ['available_tournaments' => $available_tournaments]);
    }

    public function store(Request $request){

        $validator = Validator::make(Input::all(), Banner::$rules);

        if ($validator->fails()) {
            return Redirect::action('BannerController@create')
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }

        $banner = new Banner;

        $banner->title      = Input::get('title');
        $banner->subtitle   = Input::get('subtitle');
        $banner->image_path = Input::get('image_path');
        $banner->created_at = Carbon::now();
        $banner->updated_at = $banner->created_at;

        // TODO запись турниров сюды



        $result = $banner->save();

        if ($result == false) {
            return Redirect::action('TournamentController@create')
                ->withErrors($banner->errors())
                ->withInput(Input::all());
        }

        return Redirect::action('BannerController@show', ["id" => $banner->id])->with('success', 'Данные сохранены');
    }

    public function edit($id){

        $available_tournaments = Tournament::all();
        $banner = Banner::find($id);

        return view('admin.banners.edit', [
            'banner' => $banner,
            'available_tournaments' => $available_tournaments
        ]);
    }

    public function update(Request $request, $id){

        $validator = Validator::make(Input::all(), Banner::$rules);

        if ($validator->fails()) {
            return Redirect::action('BannerController@create')
                ->withErrors($validator->errors())
                ->withInput(Input::all());
        }

        /** @var Banner $banner */
        $banner = Banner::find($id);

        $banner->title      = Input::get('title');
        $banner->subtitle   = Input::get('subtitle');
        $banner->image_path = Input::get('image_path');
        $banner->updated_at = Carbon::now();

        // TODO запись турниров сюды




        $result = $banner->save();

        if ($result == false) {
            return Redirect::action('BannerController@create')
                ->withErrors($banner->errors())
                ->withInput(Input::all());
        }
        return Redirect::action('BannerController@show', ["id" => $banner->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id){
        /** @var Banner $instance */
        $instance = Banner::find($id);
        $result = $instance->delete();

        if ($result == true)
    {
            $message = "Запись ID".$instance->id." удалена из базы";
            $type = Constants::Success;
        }
        else
        {
            $message = "Запись ID".$instance->id." не удалена из базы<br>";
            $errors = $instance->errors();
            foreach ($errors as $error) {
                $message .= $error."<br>";
            }
            $type = Constants::Error;
        }
        flash($message, $type);
        return Redirect::action('BannerController@index');
    }
}
