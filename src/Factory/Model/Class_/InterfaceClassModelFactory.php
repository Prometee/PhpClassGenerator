<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Model\Class_\InterfaceClassInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<InterfaceClassInterface> $modelClass */
final class InterfaceClassModelFactory extends AbstractDecoratedClassModelFactory implements InterfaceClassModelFactoryInterface
{
    public function create(?UsesInterface $uses = null): InterfaceClassInterface
    {
        $uses = $uses ?? $this->decoratedClassModelFactory->getUsesModelFactory()->create();

        return new $this->modelClass(
            $uses,
            $this->decoratedClassModelFactory->getPhpDocModelFactory()->create(),
            $this->decoratedClassModelFactory->getAttributeModelFactory()->create(),
            $this->decoratedClassModelFactory->getPropertiesModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getMethodsModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getTraitsModelFactory()->create($uses)
        );
    }
}
