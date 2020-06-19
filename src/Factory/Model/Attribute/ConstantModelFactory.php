<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use LogicException;
use Prometee\PhpClassGenerator\Model\Attribute\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class ConstantModelFactory extends AbstractDecoratedPropertyModelFactory implements ConstantModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstantInterface
    {
        $constant = $this->decoratedModelFactory->create($uses);

        if (false === $constant instanceof ConstantInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                ConstantInterface::class
            ));
        }

        return $constant;
    }
}
