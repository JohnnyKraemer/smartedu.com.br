<?php

namespace App\Http\Middleware;

use Closure;

class Developer
{
    public function handle($request, Closure $next)
    {
        if (!\Auth::check()) {
            return redirect('login');
        } else {
            $loggedUser = \Auth::user();
            if ($loggedUser->position_id == 1) {
                return $next($request);
            }else {
                $request->session()->flash('type', 'danger');
                $request->session()->flash('message', 'Você não tem permissão para acessar está área!');
                if ($loggedUser->position_id == 2) {
                    return redirect('admin/institution');
                }else if ($loggedUser->position_id == 3) {
                    return redirect('admin/campus');
                }else if ($loggedUser->position_id == 4 || $loggedUser->position_id == 5) {
                    return redirect('admin/course');
                }
            }
        }
    }
}
