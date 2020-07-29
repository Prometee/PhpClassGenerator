<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Model\Class_\FinalClassInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class FinalClassModelFactory extends AbstractDecoratedClassModelFactory implements FinalClassModelFactoryInterface
{
    public function create(?UsesInterface $uses = null): FinalClassInterface
    {
        $uses = $uses ?? $this->decoratedClassModelFactory->getUsesModelFactory()->create();

        return new $this->modelClass(
            $uses,
            $this->decoratedClassModelFactory->getPhpDocModelFactory()->create(),
            $this->decoratedClassModelFactory->getPropertiesModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getMethodsModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getTraitsModelFactory()->create($uses)
        );
    }
}
