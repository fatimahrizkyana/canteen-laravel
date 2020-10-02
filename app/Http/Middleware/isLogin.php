<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class isLogin
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
        if (Session::has('is_login') && Session::get('is_login') == TRUE) {
            return $next($request);
        }
        
        return redirect()->route('login')
            ->with('alert', 'Mohon maaf anda belum login.')
            ->with('type', 'danger');
    }
}
