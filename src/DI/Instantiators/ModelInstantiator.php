<?php

namespace Bellisq\Bellisq\DI\Instantiators;

use Bellisq\MVC\ModelAbstract;
use Bellisq\TypeMap\DI\Instantiator;


class ModelInstantiator
    extends Instantiator
{
    public function supports(string $type): bool
    {
        return is_subclass_of($type, ModelAbstract::class, true);
    }
}