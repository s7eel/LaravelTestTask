<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class MyAuthController extends Controller
{

    /**
     * Аутентификация пользователя
     * Или добавление нового пользователя с автоматической авторизацией
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = array(
                'name' => 'required',
                'password' => 'required',
            );
            $this->validate($request, $rules);
        }
        $array = $request->all();
        if (Auth::attempt([
            'name' => $array['name'],
            'password' => $array['password'],
        ])
        ) {
            return redirect()->intended('/');
        } else {
            $this->validate($request, [
                'name' => 'unique:users',
            ]);
            $user = new User([
                'name' => $array['name'],
                'password' => bcrypt($array['password']),
                'email' => 'default',
            ]);
            $user->save();
            Auth::login($user);
            return redirect()->intended('/');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * Деавторизация пользователя с сайта
     */
    public function logoutUser()
    {
        $user = Auth::user();
        Auth::logout($user);
        return redirect()->route('index_page');
    }
}
