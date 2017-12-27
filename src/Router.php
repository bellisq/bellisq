<?php

namespace Bellisq\Bellisq;

use Bellisq\Routes\RouteObject;
use Bellisq\Routes\StandardRouter;


class Router
    extends StandardRouter
{
    protected function register(RouteObject $routeObject)
    {
        $routeObject
            ->get('/')
            ->name('')
            ->handler = function () {
            return 3;
        };
    }
}