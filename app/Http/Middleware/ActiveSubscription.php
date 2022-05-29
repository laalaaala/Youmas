<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActiveSubscription
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

        $user = Auth::user();
        if ($user->type == 'business' && !$user->subscription || $user->type == 'business' && $user->subscription->status == 'inactive') {
            return redirect('/dashboard');
        } else {
            return $next($request);
        }
    }
}
