<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClassInterface;

abstract class AbstractDecoratedClassModelFactory extends AbstractModelFactory
{
    /**
     * @param class-string<AbstractClassInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected ClassModelFactoryInterface $decoratedClassModelFactory
    ) {
        parent::__construct($modelClass);
    }
}
