<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

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
