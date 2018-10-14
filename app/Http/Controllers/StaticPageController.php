<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 10/14/18
 * Time: 8:42 AM
 */

namespace App\Http\Controllers;


use App\Helpers\Constants;
use App\Helpers\FrontDataFiller;
use App\Models\StaticPage;
use App\ViewModels\Front\Home\StaticPageFrontViewModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class StaticPageController extends Controller
{
    public function index()
    {
        $static_pages = StaticPage::all();

        return view('admin.static_pages.index', ['static_pages' => $static_pages]);
    }

    public function show($id)
    {
        /** @var StaticPage $static_page */
        $static_page = StaticPage::find($id);

        $static_page->decodeHtmlContent();

        return view('admin.static_pages.show', ['static_page' => $static_page]);
    }

    public function edit($id)
    {
        $static_page = StaticPage::find($id);

        return view('admin.static_pages.edit', ['static_page' => $static_page]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), StaticPage::$rules);

        if ($validator->fails()) {
            return \Redirect::back()
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        /** @var StaticPage $static_page */
        $static_page = StaticPage::find($id);
        $static_page->title             = Input::get('title');
        $static_page->encodeHtmlContent(Input::get('content'));
        $static_page->updated_at        = Carbon::now();

        if (!$static_page->save()) {
            return \Redirect::back()
                ->withErrors($validator->errors())
                ->withInput($request->input());
        }

        flash("Данные сохранены!", Constants::Success);

        return Redirect::action('StaticPageController@show', ["id" => $static_page->id])->with('success', 'Данные сохранены');
    }

    public function preview(Request $request){
        // СОХРАНЯТЬ НЕ НУЖНО! Напоминание себе и потомкам

        /** @var StaticPage $staticPage */
        $staticPage = new StaticPage;

        $staticPage->title            = Input::get('title');
        $staticPage->content          = Input::get('content');
        $staticPage->created_at       = Carbon::now();
        $staticPage->updated_at       = Carbon::now();

        $model = new StaticPageFrontViewModel();
        $model->pageTitle = "Предпросмотр статичной страницы";
        $model->staticPage = $staticPage;
        FrontDataFiller::create($model)->fill();


        return view('front.home.static_page', ["model" => $model]);
    }
}