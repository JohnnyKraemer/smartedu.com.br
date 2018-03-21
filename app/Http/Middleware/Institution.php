<?php

namespace App\Http\Middleware;

use Closure;

class Institution
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            return redirect('login');
        } else {
            $loggedUser = \Auth::user();
            if($loggedUser->position_id != 1) {
                if ($loggedUser->position_id != 5) {
                    return redirect('/');
                }
            }
            return $next($request);
        }
    }
}
