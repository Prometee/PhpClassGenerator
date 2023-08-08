<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;

/** @property class-string<ConstantInterface> $modelClass */
final class ConstantModelFactory extends AbstractDecoratedPropertyModelFactory implements ConstantModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstantInterface
    {
        return new $this->modelClass(
            $uses,
            $this->decoratedModelFactory->getPhpDocModelFactory()->create()
        );
    }
}
