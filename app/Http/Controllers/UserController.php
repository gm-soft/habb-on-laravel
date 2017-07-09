<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Gamer;
use App\User;
use App\ViewModels\Back\UserShowViewModel;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            "users" => $users
        ]);
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->input(), User::$rules);

        if ($validator->passes())
        {
            $user = new User();
            $user->name  = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->role = $request->input('role');

            $user->save();
            flash('Пользователь создан', Constants::Success);
            return redirect('/admin/users');
        }
        flash('Обнаружены проблемы валидации', Constants::Error);
        return \Redirect::back()
            ->withInput()
            ->withErrors($validator->errors());
    }


    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        $model = new UserShowViewModel();
        $model->user = $user;
        $model->gamer = $user->gamer();

        return view('admin.users.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        /** @var User $user */
        $user = User::find($id);
        if ($user->Validate($request->input(), true))
        {
            $user->name  = $request->input('name');
            $user->email = $request->input('email');
            $user->role = $request->input('role');

            $user->save();
            flash('Пользователь создан', Constants::Success);
            return redirect('/admin/users');
        }
        flash('Обнаружены проблемы валидации<br>'.$user->GetValidateErrors(), Constants::Error);
        return \Redirect::back()
            ->withInput()
            ->withErrors($user->GetValidateErrors());
    }



    public function destroy($id)
    {
        /** @var User $instance */
        $instance = User::find($id);
        $instance->delete();
        return \Redirect::action('UserController@index')
            ->with('success', "Пользователь $id был удален");
    }
}
