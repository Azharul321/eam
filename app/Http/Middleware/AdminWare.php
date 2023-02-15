<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $checkAdm = User::where('email', session()->get('email'))->first();

        if(!$checkAdm && $request->path() != url('/login-page')) {
            return redirect()->route('loginPage')->with('fail', 'You must logged in');
        }
        elseif($checkAdm && $request->path() == url('/login-page')){
            return back();
        }
       
        return $next($request)->header('Cache-control','no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expires','Sat 01 Jan 1900 00:00:00 GMT');
    }
}
