<?php
/**
 * User: liwd0203@gmail.com
 * Date: 2017/9/7
 * Time: 上午9:39
 */

namespace App\Libraries;


use Illuminate\Routing\Router;

class CustomRouter extends Router
{
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        return (new CustomRouteRegistrar($this))->attribute($method, $parameters[0]);
    }

    protected function findRoute($request)
    {
        $this->current = $route = $this->routes->match($request);

        $this->container->instance(CustomRoute::class, $route);

        return $route;
    }

    protected function newRoute($methods, $uri, $action)
    {
        return (new CustomRoute($methods, $uri, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }
}
