<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
use App\ViewModels\Front\RatingViewModelBase;
use App\ViewModels\Front\TeamRatingViewModel;
use App\ViewModels\NewsViewModel;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function openPost($id){
        /** @var Post $post */
        $post = Post::find($id);

        $user = \Auth::user();
        if (\Auth::guest() || !$user->hasBackendRight()) {
            $post->views = $post->views+1;
            $post->save();
        }
        $post->decodeHtmlContent();


        return view('front.posts.show', ["post" => $post]);
    }

    public function news() {
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->decodeHtmlContent();
        }
        $model = new NewsViewModel($posts);

        return view('front.posts.index', ["model" => $model]);
    }

}
