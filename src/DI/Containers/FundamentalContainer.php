<?php

namespace Bellisq\Bellisq\DI\Containers;

use Bellisq\Bellisq\DI\Providers\ConfigProvider;
use Bellisq\Bellisq\Router;
use Bellisq\Fundamental\Logger\MonologProvider;
use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Psr\Log\LoggerInterface;


/**
 * [Class] Fundamental Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 *
 * @property-read LoggerInterface $logger
 * @property-read Router          $router
 */
class FundamentalContainer
    extends Container
{
    /**
     * @inheritdoc
     */
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerClass(ConfigProvider::class)
            ->registerClass(MonologProvider::class)
            ->registerSingleton(function (): Router {
                return new Router;
            });
    }

    /**
     * @param string $name
     * @return object
     */
    public function __get(string $name)
    {
        $map = [
            'logger' => LoggerInterface::class,
            'router' => Router::class,
        ];

        if (isset($map[$name])) {
            return $this->getObject($map[$name]);
        }
    }
}