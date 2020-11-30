<?php

namespace App\Http\Controllers;


use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        foreach (json_decode(Storage::get('users/users.json')) as $user)
        {
            if(
                $user->username == $request->username &&
                $user->password == $request->password
            ) {
                $genericUser = new GenericUser(
                    [
                        'id' => $request->username,
                        'username' => $request->username,
                        'password' => $request->password
                    ]);
                Auth::login($genericUser);
                return redirect()->route('home');
            }
        }
        return redirect()->route('home', ['loginError' => 1]);
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('home');
    }
}
