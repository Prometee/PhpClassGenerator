<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

/** @property class-string<PropertyInterface> $modelClass */
abstract class AbstractDecoratedPropertyModelFactory extends AbstractModelFactory
{
    /**
     * @param class-string<PropertyInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected PropertyModelFactoryInterface $decoratedModelFactory
    ) {
        parent::__construct($modelClass);
    }
}
