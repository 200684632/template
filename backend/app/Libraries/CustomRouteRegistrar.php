<?php
/**
 * User: liwd0203@gmail.com
 * Date: 2017/9/7
 * Time: 上午9:40
 */

namespace App\Libraries;


use Illuminate\Routing\RouteRegistrar;

class CustomRouteRegistrar extends RouteRegistrar
{
    protected $allowedAttributes = [
        'as', 'domain', 'middleware', 'name', 'namespace', 'prefix', 'remark'
    ];
}
