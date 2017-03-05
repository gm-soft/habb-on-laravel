<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Открывает одну из статей
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function openPost($id){
        $post = Post::find($id);

        if (!\Auth::user()->hasBackendRight()) {
            $post->views = $post->views+1;
        }

        $post->save();

        return $this->View('front.posts.show', ["post" => $post]);
    }

    public function showAllPosts() {
        $posts = Post::all();
        return $this->View('front.posts.index', ["posts" => $posts]);
    }
}
