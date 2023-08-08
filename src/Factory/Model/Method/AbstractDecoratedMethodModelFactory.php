<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClassInterface;

abstract class AbstractDecoratedMethodModelFactory extends AbstractModelFactory
{
    /**
     * @param class-string<AbstractClassInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected MethodModelFactoryInterface $decoratedModelFactory
    ) {
        parent::__construct($modelClass);
    }
}
