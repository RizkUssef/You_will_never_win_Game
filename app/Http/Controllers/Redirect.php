<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

}
