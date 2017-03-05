<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Constants;
use App\Helpers\Messages;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laracasts\Flash\Flash;
use Redirect;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Переписываю, так как выкидывает исключение валидации вместо того, чтобы редиректнуть на страницу
     *
     * @param Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $all = $request->all();
        $validator = $this->validator($all);

        try {
            $result = $validator->validate();
            $user = $this->create($request->all());

            event(new Registered($user));

            $this->guard()->login($user);

            $this->registered($request, $user);
            return Redirect::to('/');
        } catch (ValidationException $ex) {

            return redirect()->back()
                ->withInput($all)
                ->withErrors($validator->errors());
        }
    }

    /**
     * Метод вызывается когда пользователь зарегистрировался
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        flash('Спасибо за регистрацию', Constants::Success);
    }
}
