<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use LogicException;
use Prometee\PhpClassGenerator\Model\ClassModel\TraitClassInterface;

final class TraitClassModelFactory extends AbstractDecoratedClassModelFactory implements TraitClassModelFactoryInterface
{
    public function create(): TraitClassInterface
    {
        $traitClass = $this->decoratedClassModelFactory->create();

        if (false === $traitClass instanceof TraitClassInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                TraitClassInterface::class
            ));
        }

        return $traitClass;
    }
}
