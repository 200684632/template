<?php

namespace App\Libraries;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

class PrivilegesManager extends Controller
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * 获取所有需要进行鉴权的路由的命名及备注信息
     *
     * @return array|\Illuminate\Routing\RouteCollection
     */
    public function getAllRouteNames()
    {
        $routes = $this->router->getRoutes();

        $routes = collect($routes)->map(function ($route) {
            $guards = $route->gatherMiddleware();

            return [
                'name' => $route->getName(),
                'remark' => $route->getRemark(),
                'guard_name' => $this->getGuardName($guards) ?? ''
            ];
        })->all();

        $routes = array_filter($routes, function($item) {
            if (! is_null($item['name']) && ! empty($item['guard_name'])) {
                return $item;
            }
        });

        return $routes;
    }

    /**
     * 获取当前路由的guard
     *
     * @param $guards
     * @return null|string
     */
    protected function getGuardName($guards)
    {
        foreach ($guards as $guard) {
            if (Str::startsWith($guard, 'auth')) {
                return Str::after($guard, ':');
            }
        }

        return null;
    }
}
