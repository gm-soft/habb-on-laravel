<?php

namespace App\Http\Middleware;

use App\Helpers\Constants;
use App\Helpers\Messages;
use Auth;
use Closure;

class AdminAccess
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
        if ($request->ajax()) {
            return $next($request);
        }

        if (!Auth::check()) {
            flash(Messages::PermissionRequired, Constants::Error);
            return redirect('/login');
        }

        if (Auth::user()->hasBackendRight()) {

            return $next($request);
        }
        flash(Messages::PermissionDenied, Constants::Error);
        return redirect('/');
    }
}
