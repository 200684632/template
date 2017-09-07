<?php

namespace App\Libraries;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;

class PrivilegesManager extends Controller
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * 获取所有的路由的命名及备注信息
     *
     * @return array|\Illuminate\Routing\RouteCollection
     */
    public function getAllRouteNames()
    {
        $routes = $this->router->getRoutes();

        $routes = collect($routes)->map(function ($route) {
            return [
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'remark' => $route->getRemark()
            ];
        })->all();

        return $routes;
    }
}
