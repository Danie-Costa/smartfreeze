<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();
        
        $userRule = auth()->user()->rule; 
        $permissions = config('permissions.user_permissions');

        if (!isset($permissions[$userRule]) || !in_array($routeName, $permissions[$userRule])) {
            return redirect('/unauthorized');
        }
        $crudMenu = $this->getCrudMenu($userRule);
        $menu = $this->getMenu($userRule);
        
        app('view')->composer('layouts.app', function ($view) use ($menu) {
            $view->with('menu', $menu);
        });
        
        app('view')->composer('partials.crude-menu', function ($view) use ($crudMenu) {
            $view->with('crudMenu', $crudMenu);
        });

        return $next($request);
    }
    public function getMenu($userRule)
    {
        $groupsPermissions = config('permissions.links');
        return $groupsPermissions[$userRule];
    }public function getCrudMenu($userRule)
    {
        $permissions = config('permissions.user_permissions');
        return $permissions[$userRule];
    }




}
