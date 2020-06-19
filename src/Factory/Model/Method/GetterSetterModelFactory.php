<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

final class GetterSetterModelFactory extends AbstractModelFactory implements GetterSetterModelFactoryInterface
{
    /** @var MethodModelFactoryInterface */
    protected $methodModelFactory;
    /** @var MethodParameterModelFactoryInterface */
    protected $methodParameterFactory;

    public function __construct(
        string $modelClass,
        MethodModelFactoryInterface $methodModelFactory,
        MethodParameterModelFactoryInterface $methodParameterFactory
    ) {
        parent::__construct($modelClass);
        $this->methodModelFactory = $methodModelFactory;
        $this->methodParameterFactory = $methodParameterFactory;
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
