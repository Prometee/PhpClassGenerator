<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use LogicException;
use Prometee\PhpClassGenerator\Model\Method\IsserSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class IsserSetterModelFactory extends AbstractDecoratedGetterSetterModelFactory implements IsserSetterModelFactoryInterface
{
    public function create(UsesInterface $uses): IsserSetterInterface
    {
        $isserSetter = $this->decoratedModelFactory->create($uses);

        if (false === $isserSetter instanceof IsserSetterInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                IsserSetterInterface::class
            ));
        }

        return $isserSetter;
    }
}
