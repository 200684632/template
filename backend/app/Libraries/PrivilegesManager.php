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

    public function getAllRouteNames()
    {
        // TODO
    }
}