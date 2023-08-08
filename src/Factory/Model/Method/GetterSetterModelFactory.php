<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<GetterSetterInterface> $modelClass */
final class GetterSetterModelFactory extends AbstractModelFactory implements GetterSetterModelFactoryInterface
{
    /**
     * @param class-string<GetterSetterInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected MethodModelFactoryInterface $methodModelFactory,
        protected MethodParameterModelFactoryInterface $methodParameterFactory
    ) {
        parent::__construct($modelClass);
    }

    public function create(UsesInterface $uses): GetterSetterInterface
    {
        return new $this->modelClass(
            $uses,
            $this->methodModelFactory->create($uses),
            $this->methodModelFactory->create($uses),
            $this->methodParameterFactory,
        );
    }

    public function getMethodModelFactory(): MethodModelFactoryInterface
    {
        return $this->methodModelFactory;
    }

    public function getMethodParameterFactory(): MethodParameterModelFactoryInterface
    {
        return $this->methodParameterFactory;
    }
}
