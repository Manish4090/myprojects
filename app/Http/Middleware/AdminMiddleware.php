<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		/*if(!Auth::guard('admin')->check()){
			return redirect()->route('admin.login');
		}*/
		//dd(Auth::user()->usertype);
		if(Auth::user()->usertype == null)
        {
			//dd("sdfjdk");
            return redirect('/home')->with('message','You are not Login to AdminPanel');
        }
        else
        {
            return $next($request);
        }
    }
}
