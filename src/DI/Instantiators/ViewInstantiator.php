<?php

namespace Bellisq\Bellisq\DI\Instantiators;

use Bellisq\MVC\ViewAbstract;
use Bellisq\TypeMap\DI\Instantiator;


/**
 * [Class] View Instantiator
 *
 * @author Showsay You <akizuki.c10.l65@gmail.com>
 * @copyright 2018 Bellisq. All Rights Reserved.
 * @package bellisq/bellisq
 * @since 1.0.0
 */
class ViewInstantiator
    extends Instantiator
{
    /**
     * @inheritdoc
     */
    public function supports(string $type): bool
    {
        return is_subclass_of($type, ViewAbstract::class, true);
    }
}