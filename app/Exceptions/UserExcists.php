<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserExcists extends Exception
{
    public $msg;
    public function __construct($msg){
        $this->msg = $msg;
    }
    public function report(): void{
        //to send report about the error
    }
    public function render(Request $request): Response{

        return response()->view('pages.errors.confirmed',["msg"=>$this->msg]);
        
    }
}
