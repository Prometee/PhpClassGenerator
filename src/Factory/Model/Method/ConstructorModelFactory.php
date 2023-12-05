<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Model\Method\ConstructorInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<ConstructorInterface> $modelClass */
final class ConstructorModelFactory extends AbstractDecoratedMethodModelFactory implements ConstructorModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstructorInterface
    {
        return new $this->modelClass(
            $uses,
            $this->decoratedModelFactory->getPhpDocModelFactory()->create(),
            $this->decoratedModelFactory->getAttributeModelFactory()->create(),
        );
    }
}
