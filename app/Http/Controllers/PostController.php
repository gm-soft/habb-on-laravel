<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
use Html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $posts= Post::all();
        return $this->View('admin.posts.index', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function create()
    {
        return $this->View('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->input();
        $validator = \Validator::make($input, Post::$rules);


        if ($validator->fails()) {
            return Redirect::to('admin/posts/create')
                ->withErrors($validator)
                ->withInput($input);
        }

        $post = new Post;
        $post->title = HTML::entities(Input::get('title'));
        $post->encodeHtmlContent(Input::get('content'));
        //$post->content = HTML::entities(Input::get('content'));
        $post->save();
        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('PostController@show', ["id" => $post->id])
            ->with('success', 'Данные сохранены');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->decodeHtmlContent();
        return $this->View('admin/posts/show', [
            'post' => $post,
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
        /** @var Post $post */
        $post = Post::find($id);
        $post->content = HTML::decode($post->content);
        return $this->View('admin/posts/edit', [
            'post' => $post,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
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
        $post = Post::find($id);
        $post->title = Input::get('title');
        $post->encodeHtmlContent(Input::get('content'));

        if (!$post->save()) {
            return Redirect::to('admin/posts/edit')
                ->withErrors($post->errors())
                ->withInput($input);
        }

        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('PostController@show', ["id" => $post->id])
            ->with('success', 'Данные сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        /** @var Post $post */
        $post = Post::find($id);
        $post->delete();
        flash("Пост $id был удален", Constants::Success);
        return $this->Redirect('/admin/posts/');
    }
}
