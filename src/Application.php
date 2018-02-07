<?php

namespace Bellisq\Bellisq;

use Bellisq\Bellisq\DI\Containers\FundamentalContainer;
use Bellisq\Bellisq\DI\Containers\ServiceContainer;
use Bellisq\Bellisq\DI\Instantiators\ControllerInstantiator;
use Bellisq\Bellisq\DI\Instantiators\ModelInstantiator;
use Bellisq\Bellisq\DI\Instantiators\ViewInstantiator;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\Request\Request;
use Bellisq\Request\RequestMutable;
use Bellisq\TypeMap\Utility\ArgumentAutoComplete;
use Bellisq\TypeMap\Utility\FiniteTypeMapAggregate;
use Bellisq\TypeMap\Utility\ObjectContainer;
use Bellisq\TypeMap\Utility\TypeMapAggregate;
use Throwable;


/**
 * [Class] Application
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class Application
{
    private const DIR_ROOT = __DIR__ . '/..';
    private const DIR_LOG  = self::DIR_ROOT . '/log';

    public function __construct(array $server, array $get, array $post, array $cookies, array $files, array $env)
    {
        $timeBegin = microtime(true);
        $headerSent = false;

        try {
            $fCon = new FundamentalContainer(new ObjectContainer(
                new RootDirectory(self::DIR_ROOT),
                new LogDirectory(self::DIR_LOG)
            ));
            $logger = $fCon->logger;
            try {
                $sCon = new ServiceContainer($fCon);

                $reqM = new RequestMutable($server, $get, $post, $files, $cookies);

                $reqI = new Request($reqM);
                $rRes = $fCon->router->route($reqI);

                $mIns = new ModelInstantiator(new FiniteTypeMapAggregate($fCon, $sCon));
                $vIns = new ViewInstantiator($fCon);
                $cIns = new ControllerInstantiator(new TypeMapAggregate($mIns, $fCon, $vIns), true);

                $params = $rRes->getParameters();
                $handler = $rRes->getHandler();
                $result = (new ArgumentAutoComplete(
                    new TypeMapAggregate($mIns, $fCon, $cIns, $vIns, new ObjectContainer($params, $reqI))
                ))->call($handler);

                $result->dispatch();
                $headerSent = true;

                $timeEnd = microtime(true);
                $fCon->logger->info(
                    'Time: ' . ($timeEnd - $timeBegin)
                );
            } catch (Throwable $t) {
                if (!$headerSent) {
                    header('HTTP/1.1 500 Internal Server Error');
                    echo '500 Internal Server Error';
                }
                $headerSent = true;
                $logger->emergency($t);
                die;
            }
        } catch (Throwable $t) {
            if (!$headerSent) {
                header('HTTP/1.1 500 Internal Server Error');
                echo '500 Internal Server Error';
            }
            echo $t;;
            error_log($t);
            die;
        }
    }
}