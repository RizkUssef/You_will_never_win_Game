<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class InputRequiredException extends Exception
{
    //
    public $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }
 
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response()->view("pages.errors.inputs required",compact("msg"));
    }
}
