<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        $req_next =  $next($request);
        if(Auth::check() && Auth::guard('web')->user()->is_active != '1'){

            Auth::logout();
            $request->session()->flash('alert-danger', 'Your Account is not activated yet.');
            return redirect('/user-blocked')->with('erro_login', 'Your error text');

        }
        
        return $req_next;

    }
}
