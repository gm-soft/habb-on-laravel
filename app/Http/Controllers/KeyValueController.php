<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\KeyValue;
use Html;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class KeyValueController extends Controller
{
    // TODO Реализовать
    #region CRUD
    public function index()
    {
        $instances = KeyValue::all();
        return view('admin.keyValues.index', [
            'instances'=>$instances
        ]);
    }

    public function create()
    {
        return view('admin.keyValues.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), KeyValue::$rules);
        if ($validator->fails()) {
            return Redirect::to('admin/keyValues/create')
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $instance = new KeyValue;
        $instance->key = Input::get('key');
        $instance->value = Input::get('value');

        $instance->save();
        flash("Данные сохранены!", Constants::Success);
        return Redirect::action('KeyValueController@show', ["id" => $instance->id])
            ->with('success', 'Данные сохранены');
    }

    public function show($id)
    {
        $instance = KeyValue::find($id);
        return view('admin.keyValues.show', ['instance' => $instance]);
    }

    public function edit($id)
    {
        $instance = KeyValue::find($id);
        return view('admin.keyValues.edit', ['instance' => $instance]);
    }

    public function update(Request $request, $id)
    {
        /** @var KeyValue $instance */
        $instance = KeyValue::find($id);
        $instance->key = Input::get('key');
        $instance->value = Input::get('value');

        $result = $instance->updateUniques();

        if ($result == true) {
            return Redirect::action('KeyValueController@show', ["id" => $instance->id])
                ->with('success', 'Данные сохранены');
        } else {
            return Redirect::action('KeyValueController@edit', ["id" => $id])
                ->withErrors($instance->errors())
                ->withInput($request->input());
        }

    }

    public function destroy($id)
    {
        /** @var KeyValue $post */
        $post = KeyValue::find($id);
        $post->delete();
        return Redirect::action('KeyValueController@index')
            ->with('success', "Пара $id была удален");
    }
    #endregion
}
