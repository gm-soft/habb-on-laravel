<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Banner;
use App\Models\Post;
use App\Models\Tournament;
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

        return view('front.home.index', ['model' => $model]);
    }



    public function about() {
        return view('front.home.about');
    }



    public function contacts() {
        return view('front.home.contacts');
    }


    public function news() {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->decodeHtmlContent();
        }

        $model = new NewsViewModel($posts);
        $model->pageTitle = "Новости киберсопрта";

        return view('front.posts.index', ["model" => $model]);
    }


    public function profile(Request $request){
        $currentUser = \Auth::user();
        if (is_null($currentUser)) {

            flash('Пользователь не авторизован', Constants::Warning);
            return \Redirect::to('/');
        }
        return view('auth.profile', ['model' => $currentUser]);
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


        return view('front.posts.show', ["model" => $model]);
    }

    public function openTournament($id) {

        /** @var Tournament $tournament */
        $tournament = Tournament::find($id);

        $tournament->decodeHtmlDescription();

        $topNews = Post::getTop(3);

        $model = new TournamentViewModel();
        $model->tournament = $tournament;
        $model->topNews = $topNews;

        $model->banners = $tournament->banners()->get();
        $model->banners_count = count($model->banners);

        return view('front.tournaments.show', ["model" => $model]);
    }


}
