<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use LogicException;
use Prometee\PhpClassGenerator\Model\ClassModel\FinalClassInterface;

final class FinalClassModelFactory extends AbstractDecoratedClassModelFactory implements FinalClassModelFactoryInterface
{
    public function create(): FinalClassInterface
    {
        $finalClass = $this->decoratedClassModelFactory->create();

        if (false === $finalClass instanceof FinalClassInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                FinalClassInterface::class
            ));
        }

        return $finalClass;
    }
}
