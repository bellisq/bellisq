<?php

namespace Bellisq\Bellisq;

use Bellisq\Bellisq\MVC\Controllers\WelcomeController;
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
            ->handler = function (WelcomeController $welcomeController) {
            return $welcomeController->showWelcome('Welcome to Bellisq!');
        };
    }
}