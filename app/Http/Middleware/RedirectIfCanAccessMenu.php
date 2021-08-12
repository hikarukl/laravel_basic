<?php

namespace App\Http\Middleware;

use App\Models\AdminMenu;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class RedirectIfCanAccessMenu
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
        $currentRouteName = $request->route()->getName();

        $user = \auth()->user();

        // Current user is admin then pass all
        if ($user->hasRole(Role::ROLE_ADMIN_NAME)) {
            return $next($request);
        }

        // Check user enable access menu if this route is menu
        $menuSlug = substr($currentRouteName, 0, strpos($currentRouteName, "."));

        if ($user->hasMenu($menuSlug)) {
            Log::info("User can access menu: {$menuSlug}");

            return $next($request);
        }

        return redirect($request->route()->getPrefix() . RouteServiceProvider::HOME);
    }
}
