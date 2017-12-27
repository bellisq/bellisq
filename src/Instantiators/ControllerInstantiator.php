<?php

namespace Bellisq\Bellisq\Instantiators;

use Bellisq\MVC\ControllerAbstract;
use Bellisq\TypeMap\DI\Instantiator;


class ControllerInstantiator
    extends Instantiator
{
    public function supports(string $type): bool
    {
        return is_subclass_of($type, ControllerAbstract::class, true);
    }
}