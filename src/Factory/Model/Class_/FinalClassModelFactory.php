<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use LogicException;
use Prometee\PhpClassGenerator\Model\Class_\FinalClassInterface;

final class FinalClassModelFactory extends AbstractDecoratedClassModelFactory implements FinalClassModelFactoryInterface
{
    public function create(): FinalClassInterface
    {
        $uses = $this->decoratedClassModelFactory->getUsesModelFactory()->create();

        return new $this->modelClass(
            $uses,
            $this->decoratedClassModelFactory->getPhpDocModelFactory()->create(),
            $this->decoratedClassModelFactory->getPropertiesModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getMethodsModelFactory()->create($uses),
            $this->decoratedClassModelFactory->getTraitsModelFactory()->create($uses)
        );
    }
}
