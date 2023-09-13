<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Password_reset_token;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function forget_password(){
        return view('pages.forms.forget_password');
    }

    public function forgetPasswordHandle(ForgetPasswordRequest $request){
        $user_email=DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if($user_email == null){
            $rand = Str::random(64);
            $user = DB::table('password_reset_tokens')->insert([
                "email"=>$request->email,
                "token"=>$rand,
            ]);
        }else{
            $rand = Str::random(64);
            $user = DB::table('password_reset_tokens')->where('email', $request->email)->update([
                "email"=>$request->email,
                "token"=>$rand,
            ]);
        }
        Mail::send('pages.emails.change_password', ['token'=>$rand], function ($message)use($request) {
            $message->to($request->email, $request->name);
            $message->subject('Reset Your Password');
        });
        return view('pages.emails.check_email');
    }

    public function reset_password($token){
        $user = DB::table('password_reset_tokens')->where([
            'token'=>$token
        ])->first();
        if($user){
            return view('pages.forms.reset_password',compact("token"));
        }else{
            return view('pages.emails.change_password');
        }
    }

    public function resetPasswordHandle(ResetPasswordRequest $request){
        $reset_pass=DB::table('password_reset_tokens')->where([
            'email'=>$request->email,
            'token'=>$request->token
        ])->first();
        if($reset_pass == null){
            return redirect()->route("forget_pass")->with('error', 'Unfortunately, the password reset process could not be completed due to an issue, Try Again');
        }else{
            $user=User::where("email",$request->email)->first();
            $user->update([
                "password"=>Hash::make($request->password)
            ]);
            DB::table('password_reset_tokens')->where(['email'=>$request->email])->delete();
            return redirect()->route("login")->with("success","Your password reset successfully, Don't forget your password again 🙂");
        }
    }

}
