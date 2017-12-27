<?php

namespace Bellisq\Bellisq\Containers;

use Bellisq\Bellisq\Providers\MySQLPDOProvider;
use Bellisq\TypeMap\DI\Container;
use Bellisq\TypeMap\DI\Transport\ProviderRegister;


/**
 * [Class] Service Container
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2017 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class ServiceContainer
    extends Container
{
    protected static function registerProviders(ProviderRegister $providerRegister): void
    {
        $providerRegister
            ->registerClass(MySQLPDOProvider::class);
    }
}