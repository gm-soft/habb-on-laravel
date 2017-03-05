<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Post;
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
        $post->title = Input::get('title');
        $post->content = Input::get('content');
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
        $post = Post::find($id);

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
        $post = Post::find($id);
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

        }

        $post = Post::find($id);
        $post->title = Input::get('title');
        $post->content = Input::get('content');

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
        $nerd = Post::find($id);
        $nerd->delete();
        flash('Пост был удален', Constants::Success);
        return $this->Redirect('/admin/posts/');
    }
}
