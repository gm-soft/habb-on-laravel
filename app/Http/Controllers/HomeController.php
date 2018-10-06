<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
use App\ViewModels\Front\HomePageViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $model = new HomePageViewModel();
        $model->topPostCount = 3;

        $model->posts = Post::getTop($model->topPostCount) ;

        return view('front.home.index', ['model' => $model]);
    }

    public function about() {
        return view('front.home.about');
    }

    public function contacts() {
        return view('front.home.contacts');
    }

    public function profile(Request $request){
        $currentUser = \Auth::user();
        if (is_null($currentUser)) {

            flash('Пользователь не авторизован', Constants::Warning);
            return \Redirect::to('/');
        }
        return view('auth.profile', ['model' => $currentUser]);
    }
}
