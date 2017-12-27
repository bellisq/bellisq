<?php

namespace Bellisq\Bellisq\Instantiators;

use Bellisq\MVC\ViewAbstract;
use Bellisq\TypeMap\DI\Instantiator;


class ViewInstantiator
    extends Instantiator
{
    public function supports(string $type): bool
    {
        return is_subclass_of($type, ViewAbstract::class, true);
    }
}