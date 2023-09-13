<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response{
        if(Auth()->user()->email_verified_at != null){
            return $next($request);
        }else{
            return redirect()->route('returnOTP')->withErrors("you must verify your email first ☻");
        }
    }
}
