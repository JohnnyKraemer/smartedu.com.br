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
            if ($loggedUser->position_id == 1 || $loggedUser->position_id == 2) {
                return $next($request);
            }else if ($loggedUser->position_id == 3) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                return redirect('admin/campus');
            }else if ($loggedUser->position_id == 4 || $loggedUser->position_id == 5) {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                return redirect('admin/course');
            }
        }
    }
}
