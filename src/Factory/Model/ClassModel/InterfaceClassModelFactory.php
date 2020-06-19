<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use LogicException;
use Prometee\PhpClassGenerator\Model\ClassModel\InterfaceClassInterface;

final class InterfaceClassModelFactory extends AbstractDecoratedClassModelFactory implements InterfaceClassModelFactoryInterface
{
    public function create(): InterfaceClassInterface
    {
        $interfaceClass = $this->decoratedClassModelFactory->create();

        if (false === $interfaceClass instanceof InterfaceClassInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                InterfaceClassInterface::class
            ));
        }

        return $interfaceClass;
    }
}
