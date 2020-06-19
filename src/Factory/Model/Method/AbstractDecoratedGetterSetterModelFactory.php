<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;

abstract class AbstractDecoratedGetterSetterModelFactory extends AbstractModelFactory
{
    /** @var GetterSetterModelFactoryInterface */
    protected $decoratedModelFactory;

    public function __construct(
        string $modelClass,
        GetterSetterModelFactoryInterface $decoratedGetterSetterModelFactory
    ) {
        parent::__construct($modelClass);
        $this->decoratedModelFactory = $decoratedGetterSetterModelFactory;
        $this->decoratedModelFactory->setModelClass($this->modelClass);
    }

    public function setModelClass(string $modelClass): void
    {
        $this->decoratedModelFactory->setModelClass($this->modelClass);
        parent::setModelClass($modelClass);
    }
}
