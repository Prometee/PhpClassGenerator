<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;

abstract class AbstractDecoratedPropertyModelFactory extends AbstractModelFactory implements ModelFactoryInterface
{
    /** @var PropertyModelFactoryInterface */
    protected $decoratedModelFactory;

    public function __construct(
        string $modelClass,
        PropertyModelFactoryInterface $decoratedPropertyModelFactory
    ) {
        parent::__construct($modelClass);
        $this->decoratedModelFactory = $decoratedPropertyModelFactory;
    }
}
