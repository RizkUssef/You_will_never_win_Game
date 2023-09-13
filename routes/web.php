<?php

use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("FTRU",[Redirect::class,"welcome"])->name("FTRU");
Route::get("FTRU/login",[Redirect::class,"login"])->name("login");
Route::get("FTRU/signup",[Redirect::class,"register"])->name("signup");

Route::post("FTRU/signup",[UserController::class,"handleRegister"])->name("new user");
Route::post("FTRU/login",[UserController::class,"handleLogin"])->name("access user");

Route::get('/auth/{provider}/redirect',[UserController::class,"redirect"]);
Route::get('/auth/{provider}/callback',[UserController::class, 'callback']);

Route::get("FTRU/home",[Redirect::class,"intro"])->name("home")->middleware(['auth','user_verify']);
Route::post("FTRU/logout",[UserController::class,"logout"])->name("logout");

Route::get("FTRU/signin/forget",[ForgetPasswordController::class,"forget_password"])->name("forget_pass");
Route::post('FTRU/signin/forgetpassword',[ForgetPasswordController::class,'forgetPasswordHandle'])->name('forget_password_handle');

Route::get("FTRU/reset/{token}",[ForgetPasswordController::class,"reset_password"])->name("reset_pass");
Route::post("FTRU/reset",[ForgetPasswordController::class, "resetPasswordHandle"])->name("reset_password_handle");

Route::get("FTRU/error",[Redirect::class,"errors"])->name("error");
Route::get("FTRU/wrongRoute",[Redirect::class,"handleWrongRoute"])->name("worng_route");

Route::get("FTRU/email",[Redirect::class,"send_email"])->name("email");
Route::post("FTRU/verfiy",[UserController::class,"handleOTP"])->name("verfiy");

Route::get("otpform",[Redirect::class,"otp"])->name("returnOTP");
Route::get("resend_otp",[UserController::class,"resendOTP"])->name("resend")->middleware(['throttle:send_email']);

Route::fallback(function(){
    return redirect()->route('worng_route')->withErrors("Oops! It seems like you've reached an incorrect destination");
});

Route::get("profile",function(){
    return view('pages.profile.user_profile');
});

Route::get("edit",function(){
    return view('pages.profile.edit_profile');
});

Route::get("first",function(){
    return view('pages.questions.firstQuestion');
});
