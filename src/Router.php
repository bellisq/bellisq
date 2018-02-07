<?php

namespace Bellisq\Bellisq;

use Bellisq\Bellisq\MVC\Controllers\WelcomeController;
use Bellisq\MVC\ViewAbstract;
use Bellisq\Router\RouteRegister;
use Bellisq\Router\StandardRouter;


/**
 * [Class] Router
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class Router
    extends StandardRouter
{
    /**
     * @inheritdoc
     */
    protected static function registerRoutes(RouteRegister $routeRegister): void
    {
        $routeRegister
            ->route('/')
            ->handler = function (WelcomeController $controller): ViewAbstract {
            return $controller->showWelcome('Welcome to Bellisq!');
        };
    }
}