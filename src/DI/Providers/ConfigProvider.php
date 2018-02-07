<?php

namespace Bellisq\Bellisq\DI\Providers;

use Bellisq\Fundamental\Config\ConfigProviderAbstract;
use Bellisq\Fundamental\Config\Transport\ConfigRegister;
use Bellisq\Bellisq\Configs\MySQLConfig;
use Bellisq\Bellisq\Configs\URIConfig;
use Bellisq\Fundamental\Logger\LogLevelConfig;


/**
 * [Class] Config Provider
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class ConfigProvider
    extends ConfigProviderAbstract
{
    /**
     * @inheritdoc
     */
    protected static function registerConfigs(ConfigRegister $configRegister): void
    {
        $configRegister
            ->register(MySQLConfig::class)
            ->register(LogLevelConfig::class);
    }
}