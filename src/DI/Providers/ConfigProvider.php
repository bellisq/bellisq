<?php

namespace Bellisq\Bellisq\DI\Providers;

use Bellisq\Fundamental\Config\ConfigProviderAbstract;
use Bellisq\Fundamental\Config\Standard\DebugConfig;
use Bellisq\Fundamental\Config\Standard\MySQLConfig;
use Bellisq\Fundamental\Config\Standard\URIConfig;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;


/**
 * [Class] Config Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class ConfigProvider
    extends ConfigProviderAbstract
{
    protected static function registerConfigs(ConfigRegister $configRegister): void
    {
        $configRegister
            ->register(MySQLConfig::class)
            ->register(DebugConfig::class)
            ->register(URIConfig::class);
    }
}