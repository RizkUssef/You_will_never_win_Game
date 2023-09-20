<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Http\Requests\InsertRequest;
use App\Http\Resources\InsertResourse;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionsController extends Controller
{
    //insert questions
    public function insertQuestions(InsertRequest $request){
            if($request->error_image != null){
                $error_image = Storage::putFile("errorImages", $request->error_image);
            }else{
                $error_image=null;
            }
            $question = Questions::create([
                "question" => $request->question,
                "answer" => $request->answer,
                "error_text" => $request->error_text,
                "error_image" => $error_image,
            ]);
            return response()->json([
                "msg"=>"okey",
                "pop"=>new InsertResourse($question)
            ],200);
    }

    public function startGame(){
        $question = Questions::first();
        $next = Questions::select("id")->where('id', '>', $question->id)->first();
        return view("pages.questions.firstQuestion",compact("question","next"));
    }

    public function showOne($id){
        $question = Questions::find($id);
        $next = Questions::select("id")->where('id', '>', $id)->first();
        if($next!=null){
            return view("pages.questions.firstQuestion",compact("question","next"));
        }else{
            return redirect()->route("gameover");
        }
    }

    public function handleAnswer(AnswerRequest $request){
        $real_answer = Questions::where("id",decrypt($request->id))->first();
        if($real_answer){
            if(session()->has("user")){
                $user=session()->get("user");
                $new_user=User::find($user->id);
                if($real_answer->answer != $request->answer){
                    Session::flash("real_answer",$real_answer);
                    $new_user->update([
                        "wrong_answers"=>$new_user->wrong_answers++
                    ]);
                    return redirect()->back();
                }else{
                    Session::flash("right_answer","right");
                    // $question = Questions::where('id', '>',$real_answer->id )->first();
                    $new_user->update([
                        "correct_answers"=>$new_user->correct_answers++
                    ]);
                    // return redirect()->route("first_question",["question",$question]);
                    return redirect()->back();
                }
            }else{
                return redirect()->route("login")->withErrors("your session is expired, login agian");
            }
        }
    }

}
