<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use LogicException;
use Prometee\PhpClassGenerator\Model\Method\ConstructorInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class ConstructorModelFactory extends AbstractDecoratedMethodModelFactory implements ConstructorModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstructorInterface
    {
        $constructor = $this->decoratedModelFactory->create($uses);

        if (false === $constructor instanceof ConstructorInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                ConstructorInterface::class
            ));
        }

        return $constructor;
    }
}
