<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Model\Class_\AbstractClassInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property AbstractClassInterface $modelClass */
final class AbstractClassModelFactory extends AbstractDecoratedClassModelFactory implements AbstractClassModelFactoryInterface
{
    public function create(?UsesInterface $uses = null): AbstractClassInterface
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
