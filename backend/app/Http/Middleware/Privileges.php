<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class Privileges extends Authenticate
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($guards);

        if (! empty($guards)) {
            // 如果是admin权限则默认访问所有
            if ($request->user()->hasRole('admin')) {
                return $next($request);
            }

            // 判断是否有权限访问
            $role = $request->route()->getName() ?? '';

            try {
                if (empty($role) || ! $request->user()->hasPermissionTo($role)) {
                    return $this->apiError('没有权限访问');
                }
            } catch (\Exception $exception) {
                return $this->apiError('没有权限访问');
            }
        }

        return $next($request);
    }
}
