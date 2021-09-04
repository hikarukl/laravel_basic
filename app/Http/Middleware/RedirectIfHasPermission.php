<?php

namespace App\Http\Middleware;

use App\Models\AdminMenu;
use App\Models\Permission;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class RedirectIfHasPermission
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

        // Check user enable access permission
        $menuSlug = substr($currentRouteName, 0, strpos($currentRouteName, "."));

        if ($user->hasMenu($menuSlug)) {

            foreach (Permission::LIST_PERMISSION_CHECK as $permissionCheck) {
                if (preg_match("/($permissionCheck)/", $currentRouteName)) {
                    if ($user->hasPermission($currentRouteName)) {
                        Log::info("User can access route permission: {$currentRouteName}");

                        return $next($request);
                    } else {
                        return redirect($request->route()->getPrefix() . RouteServiceProvider::HOME);
                    }
                }
            }
            return $next($request);
        }

        return redirect($request->route()->getPrefix() . RouteServiceProvider::HOME);
    }
}
