<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Container\Container;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;

class Privileges
{
    use ApiResponse;

    public $router;

    function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (! empty($guards)) {
            // 判断是否有权限访问

            $role = \Route::currnetRouteName();

            try {
                if (empty($role) || ! $request->user()->hasDirectPermission($role)) {
                    return $this->apiError('没有权限访问');
                }
            } catch (\Exception $exception) {
                return $this->apiError('没有权限访问');
            }
        }

        return $next($request);
    }
}
