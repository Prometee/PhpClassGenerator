<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

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
        $this->decoratedModelFactory->setModelClass($this->modelClass);
    }

    public function setModelClass(string $modelClass): void
    {
        $this->decoratedModelFactory->setModelClass($this->modelClass);
        parent::setModelClass($modelClass);
    }
}
