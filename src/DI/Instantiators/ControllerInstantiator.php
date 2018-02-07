<?php

namespace Bellisq\Bellisq\DI\Instantiators;

use Bellisq\MVC\ControllerAbstract;
use Bellisq\TypeMap\DI\Instantiator;


/**
 * [Class] Controller Instantiator
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class ControllerInstantiator
    extends Instantiator
{
    /**
     * @inheritdoc
     */
    public function supports(string $type): bool
    {
        return is_subclass_of($type, ControllerAbstract::class, true);
    }
}