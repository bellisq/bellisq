<?php

namespace Bellisq\Bellisq;

use Bellisq\Bellisq\Containers\FundamentalContainer;
use Bellisq\Bellisq\Containers\ServiceContainer;
use Bellisq\Frontend\RequestImmutable;
use Bellisq\Frontend\RequestMutable;
use Bellisq\Fundamental\Directory\LogDirectory;
use Bellisq\Fundamental\Directory\RootDirectory;
use Bellisq\TypeMap\Utility\ObjectContainer;
use PDO;


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
        $requestMutable = new RequestMutable($get, $post, $cookies, $files, $server);

        $requestImmutable = new RequestImmutable($requestMutable);


        $fundamentalContainer = new FundamentalContainer(new ObjectContainer(
            new RootDirectory(self::DIR_ROOT),
            new LogDirectory(self::DIR_LOG)
        ));

        $serviceContainer = new ServiceContainer($fundamentalContainer);
        $serviceContainer->get('PDO');
    }
}