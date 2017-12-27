<?php

namespace Bellisq\Bellisq\DI\Containers;

use Bellisq\Bellisq\DI\Providers\ConfigProvider;
use Bellisq\Fundamental\Logger\MonologProvider;
use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;
use Psr\Log\LoggerInterface;


/**
 * [Class] Fundamental Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 *
 * @property-read LoggerInterface $logger
 */
class FundamentalContainer
    extends Container
{
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerClass(ConfigProvider::class)
            ->registerClass(MonologProvider::class);
    }

    public function __get(string $name)
    {
        $map = [
            'logger' => LoggerInterface::class
        ];

        if (isset($map[$name])) {
            return $this->get($map[$name]);
        }
    }
}