<?php

namespace Bellisq\Bellisq;

use Bellisq\Bellisq\DI\Containers\FundamentalContainer;
use Bellisq\Bellisq\DI\Containers\ServiceContainer;
use Bellisq\Bellisq\DI\Instantiators\ControllerInstantiator;
use Bellisq\Bellisq\DI\Instantiators\ModelInstantiator;
use Bellisq\Bellisq\DI\Instantiators\ViewInstantiator;
use Bellisq\Frontend\RequestImmutable;
use Bellisq\Frontend\RequestMutable;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\MVC\ViewAbstract;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Bellisq\TypeMap\Utility\FiniteTypeMapAggregate;
use Bellisq\TypeMap\Utility\ObjectContainer;
use Bellisq\TypeMap\Utility\TypeMapAggregate;


/**
 * [Class] Application
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class Application
{
    private const DIR_ROOT = __DIR__ . '/..';
    private const DIR_LOG = self::DIR_ROOT . '/log';

    public function __construct(
        array $server,
        array $get,
        array $post,
        array $cookies,
        array $files,
        array $env)
    {
        $timeBegin = microtime(true);

        $fundamentalContainer = new FundamentalContainer(new ObjectContainer(
            new RootDirectory(self::DIR_ROOT),
            new LogDirectory(self::DIR_LOG)
        ));

        $serviceContainer = new ServiceContainer($fundamentalContainer);

        $requestMutable = new RequestMutable($get, $post, $cookies, $files, $server);

        $requestImmutable = new RequestImmutable($requestMutable);

        $routeResult = (new Router())->route($requestImmutable);

        $modelInstantiator = new ModelInstantiator(
            new FiniteTypeMapAggregate($fundamentalContainer, $serviceContainer)
        );

        $viewInstantiator = new ViewInstantiator($fundamentalContainer);

        $controllerInstantiator = new ControllerInstantiator(
            new TypeMapAggregate(
                $modelInstantiator, $fundamentalContainer, $viewInstantiator
            ), true
        );

        if (is_null($routeResult)) {
            header('HTTP/1.0 404 Not Found');
        } else {
            $parameters = $routeResult->getParameters();
            $routeComplete = new ArgumentAutoComplete(new TypeMapAggregate(
                $modelInstantiator,
                $fundamentalContainer,
                $controllerInstantiator,
                $viewInstantiator,
                new ObjectContainer($parameters)
            ));

            $processor = $routeResult->getProcessor();
            $result = $routeComplete->call($processor);

            if ($result instanceof ViewAbstract) {
                $result->dispatch();
            } else {
                print_r($result);
            }
        }

        $timeEnd = microtime(true);
        $fundamentalContainer->logger->info(
            'Time: ' . ($timeEnd - $timeBegin)
        );
    }
}