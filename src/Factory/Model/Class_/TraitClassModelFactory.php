<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Model\Class_\TraitClassInterface;

final class TraitClassModelFactory extends AbstractDecoratedClassModelFactory implements TraitClassModelFactoryInterface
{
    public function create(): TraitClassInterface
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
