<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;

abstract class AbstractDecoratedMethodModelFactory extends AbstractModelFactory
{
    /** @var MethodModelFactoryInterface */
    protected $decoratedModelFactory;

    public function __construct(
        string $modelClass,
        MethodModelFactoryInterface $decoratedMethodModelFactory
    ) {
        parent::__construct($modelClass);
        $this->decoratedModelFactory = $decoratedMethodModelFactory;
        $this->decoratedModelFactory->setModelClass($this->modelClass);
    }

    public function setModelClass(string $modelClass): void
    {
        $this->decoratedModelFactory->setModelClass($this->modelClass);
        parent::setModelClass($modelClass);
    }
}
