<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\FrontDataFiller;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Tournament;
use App\ViewModels\Front\Auth\ProfileFormViewModel;
use App\ViewModels\Front\Home\AboutHomeViewModel;
use App\ViewModels\Front\Home\ContactHomeViewModel;
use App\ViewModels\Front\HomePageViewModel;
use App\ViewModels\Front\ShowPostViewModel;
use App\ViewModels\Front\TournamentViewModel;
use App\ViewModels\NewsViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $model = new HomePageViewModel;
        $model->topPostCount = 3;

        $model->posts = Post::getTop($model->topPostCount);
        $model->banners = Banner::getForMainPage();

        $model->banners_count = count($model->banners);

        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();

        return view('front.home.index', ['model' => $model]);
    }



    public function about() {

        $model = new AboutHomeViewModel();
        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();

        return view('front.home.about', ['model' => $model]);
    }



    public function contacts() {

        $model = new ContactHomeViewModel();
        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();

        return view('front.home.contacts', ['model' => $model]);
    }


    public function news(Request $request) {

        $hashtagFilter = $request->query('hashtag');
        $hasHashtag = isset($hashtagFilter);

        $posts = $hasHashtag ? Post::searchByHashtags($hashtagFilter) : Post::all();

        foreach ($posts as $post) {
            $post->decodeHtmlContent();
        }

        $model = new NewsViewModel($posts);
        $model->pageTitle = $hasHashtag ? "Поиск новостей по тегу #{$hashtagFilter}:" : "Новости киберсопрта";

        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();

        return view('front.posts.index', ["model" => $model]);
    }


    public function profile(Request $request){
        $currentUser = \Auth::user();
        if (is_null($currentUser)) {

            flash('Пользователь не авторизован', Constants::Warning);
            return \Redirect::to('/');
        }

        $model = new ProfileFormViewModel;
        $model->current_user = $currentUser;
        FrontDataFiller::create($model)->fill();

        // TODO Gorbatyuk: сделать вьюмодели с заполненным списком турниров в шапке во всех остальных страницах авторизации
        return view('auth.profile', ['model' => $model]);
    }

    public function openPost($id){
        /** @var Post $post */
        $post = Post::find($id);

        $topPosts = Post::getTop(3, $id);

        $user = \Auth::user();
        if (\Auth::guest() || !$user->hasBackendRight()) {
            $post->views = $post->views+1;
            $post->save();
        }
        $post->decodeHtmlContent();

        $model = new ShowPostViewModel();
        $model->post = $post;
        $model->topPosts = $topPosts;
        $model->hasAnotherPosts = count($topPosts) > 0;

        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();


        return view('front.posts.show', ["model" => $model]);
    }

    public function openTournament($id) {

        /** @var Tournament $tournament */
        $tournament = Tournament::find($id);

        $tournament->decodeHtmlDescription();

        $topNews = Post::searchByHashtags($tournament->getHashtagsAsArray(), 3);

        $model = new TournamentViewModel();
        $model->tournament = $tournament;
        $model->topNews = $topNews;

        $model->banners = $tournament->banners()->get();
        $model->banners_count = count($model->banners);

        $frontHelper = new FrontDataFiller($model);
        $frontHelper->fill();

        return view('front.tournaments.show', ["model" => $model]);
    }


}
