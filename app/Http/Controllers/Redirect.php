<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Redirect extends Controller
{

    public function welcome(){
        return view('index');
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function intro(){
        return view('pages.intro.intro');
    }

    public function errors(){
        return view('pages.errors.confirmed');
    }

    public function handleWrongRoute(){
        return view('pages.errors.wrong_route');
    }

    public function otp(){
        return view('pages.forms.otp');
    }

    public function send_email(){
        return view('pages.emails.verfiy');
    }

    public function profile(){
        $user= Auth::user();
        $user_data=User::find($user->id);
        return view('pages.profile.user_profile',compact("user_data"));
    }

    public function editProfile(){
        $user= Auth::user();
        $user_data=User::find($user->id);
        return view('pages.profile.edit_profile',compact("user_data"));
    }

    public function changePassword(){
        return view("pages.profile.change_password");
    }

    public function gameOver(){
        return view('pages.questions.gameover');
    }

}