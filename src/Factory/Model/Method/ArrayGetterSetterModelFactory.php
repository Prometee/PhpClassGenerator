<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Model\Method\ArrayGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class ArrayGetterSetterModelFactory extends AbstractDecoratedGetterSetterModelFactory implements ArrayGetterSetterModelFactoryInterface
{
    public function create(UsesInterface $uses): ArrayGetterSetterInterface
    {
        return new $this->modelClass(
            $uses,
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodParameterFactory()
        );
    }
}
