<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
use App\ViewModels\Front\ShowPostViewModel;
use App\ViewModels\NewsViewModel;
use Carbon\Carbon;
use Html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class PostController extends Controller
{

    #region CRUD
    public function index()
    {
        $posts= Post::all();
        return view('admin.posts.index', ["posts" => $posts]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $validator = \Validator::make($input, Post::$rules);


        if ($validator->fails()) {
            return Redirect::to('admin/posts/create')
                ->withErrors($validator)
                ->withInput($input);
        }

        $post                   = new Post;
        $post->title            = HTML::entities(Input::get('title'));
        $post->encodeHtmlContent(Input::get('content'));
        $post->announce_image   = Input::get('announce_image');
        $post->hashtags         = Input::get('hashtags');

        if (!$post->save()) {
            return Redirect::to('admin/posts/create')
                ->withErrors($post->errors())
                ->withInput($input);
        }

        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('PostController@show', ["id" => $post->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->decodeHtmlContent();
        return view('admin/posts/show', [
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->content = HTML::decode($post->content);
        return view('admin/posts/edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $validator = Validator::make($input, Post::$rules);

        if ($validator->fails()) {
            return Redirect::to('admin/posts/edit')
                ->withErrors($validator->errors())
                ->withInput($input);
        }

        /** @var Post $post */
        $post                   = Post::find($id);
        $post->title            = Input::get('title');
        $post->encodeHtmlContent(Input::get('content'));
        $post->announce_image   = Input::get('announce_image');
        $post->hashtags         = Input::get('hashtags');

        if (!$post->save()) {
            return Redirect::to('admin/posts/edit')
                ->withErrors($post->errors())
                ->withInput($input);
        }

        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('PostController@show', ["id" => $post->id])
            ->with('success', 'Данные сохранены');
    }

    public function destroy($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->delete();
        flash("Пост $id был удален", Constants::Success);
        return Redirect::to('admin/posts/');
    }
    #endregion

    public function postPreview(Request $request){

        // СОХРАНЯТЬ НЕ НУЖНО! Напоминание себе и потомкам

        /** @var Post $post */
        $post = new Post;

        $post->title            = Input::get('title');
        $post->announce_image   = Input::get('imageLink');
        $post->content          = Input::get('content');
        $post->views            = 1488;
        $post->hashtags         = Input::get('hashtags');
        $post->created_at       = Carbon::now();
        $post->updated_at       = Carbon::now();

        $topPosts = Post::getTop(3);

        $model = new ShowPostViewModel();
        $model->post = $post;
        $model->topPosts = $topPosts;
        $model->hasAnotherPosts = count($topPosts) > 0;


        return view('front.posts.show', ["model" => $model]);

    }

    public function postAnnouncePreview(Request $request){

        // СОХРАНЯТЬ НЕ НУЖНО! Напоминание себе и потомкам

        $previewPost = new Post;

        $previewPost->id                = 0;
        $previewPost->title             = HTML::entities(Input::get('title'));
        $previewPost->announce_image    = Input::get('announce_image');
        $previewPost->hashtags          = Input::get('hashtags');

        $topPosts = Post::getTop(3)->toArray();

        $posts = array();
        $posts[] = $previewPost;
        foreach ($topPosts as $topPost){
            $posts[] = $topPost;
        }

        $viewModel = new NewsViewModel($posts);
        $viewModel->pageTitle = "Предпросмотр анонса новости";

        return view('front.posts.index', ['model' => $viewModel]);
    }
}
