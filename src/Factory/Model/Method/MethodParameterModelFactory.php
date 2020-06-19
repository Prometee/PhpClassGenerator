<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class MethodParameterModelFactory extends AbstractModelFactory implements MethodParameterModelFactoryInterface
{
    public function create(UsesInterface $uses): MethodParameterInterface
    {
        return new $this->modelClass($uses);
    }
}
