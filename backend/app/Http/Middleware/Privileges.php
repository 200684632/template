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
            // 判断是否有权限访问
            $role = $request->route()->getName() ?? '';

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
