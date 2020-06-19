<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use LogicException;
use Prometee\PhpClassGenerator\Model\ClassModel\AbstractClassInterface;

final class AbstractClassModelFactory extends AbstractDecoratedClassModelFactory implements AbstractClassModelFactoryInterface
{
    public function create(): AbstractClassInterface
    {
        $abstractClass = $this->decoratedClassModelFactory->create();

        if (false === $abstractClass instanceof AbstractClassInterface) {
            throw new LogicException(sprintf(
                'The created class should be an instance of %s !',
                AbstractClassInterface::class
            ));
        }

        return $abstractClass;
    }
}
