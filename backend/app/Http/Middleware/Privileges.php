<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;

class Privileges
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = '')
    {
        $role = emptyArray($role) ? \Route::currentRouteName() : $role;

//        if (empty($role) || ! $request->user()->hasDirectPermission($role)) {
//            return $this->apiError('无权访问!');
//        }

        return $next($request);
    }
}
