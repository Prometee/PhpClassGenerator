<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Model\Method\IsserSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class IsserSetterModelFactory extends AbstractDecoratedGetterSetterModelFactory implements IsserSetterModelFactoryInterface
{
    public function create(UsesInterface $uses): IsserSetterInterface
    {
        return new $this->modelClass(
            $uses,
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodModelFactory()->create($uses),
            $this->decoratedModelFactory->getMethodParameterFactory()
        );
    }
}
