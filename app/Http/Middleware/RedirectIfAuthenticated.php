<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $user = Auth::user();

        if ($user) {
            // User already locked and need wait
            $current = Carbon::now();
            $unlockDateTime = $user->unlock_login_at ? Carbon::parse($user->unlock_login_at) : '';

            if ($unlockDateTime && $unlockDateTime->gt($current)) {
                Auth::logout();

                $minutesWait = $unlockDateTime->diff($current)->format("%i minutes %s seconds");
                return redirect(route('login'))->with('status', "Your account was locked. Please try again after: {$minutesWait}.");
            }

            return redirect(RouteServiceProvider::HOME);
        }
    }
}
