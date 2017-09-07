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
                'remark' => $route->getRemark()
            ];
        })->all();

        $routes = array_filter($routes, function($item) {
            if (! is_null($item['name'])) {
                return $item;
            }
        });

        return $routes;
    }
}
