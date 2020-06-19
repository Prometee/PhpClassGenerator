<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\ClassModel\ClassModelInterface;

final class ClassModelFactory extends AbstractModelFactory implements ClassModelFactoryInterface
{
    /** @var UsesModelFactoryInterface */
    protected $usesModelFactory;
    /** @var PropertiesModelFactoryInterface */
    protected $propertiesModelFactory;
    /** @var MethodsModelFactoryInterface */
    protected $methodsModelFactory;
    /** @var TraitsModelFactoryInterface */
    protected $traitsModelFactory;

    public function __construct(
        string $modelClass,
        UsesModelFactoryInterface $usesModelFactory,
        PropertiesModelFactoryInterface $propertiesModelFactory,
        MethodsModelFactoryInterface $methodsModelFactory,
        TraitsModelFactoryInterface $traitsModelFactory
    ) {
        parent::__construct($modelClass);
        $this->usesModelFactory = $usesModelFactory;
        $this->propertiesModelFactory = $propertiesModelFactory;
        $this->methodsModelFactory = $methodsModelFactory;
        $this->traitsModelFactory = $traitsModelFactory;
    }

    public function create(): ClassModelInterface
    {
        $uses = $this->usesModelFactory->create();
        $properties = $this->propertiesModelFactory->create($uses);
        $methods = $this->methodsModelFactory->create($uses);
        $traits = $this->traitsModelFactory->create($uses);

        return new $this->modelClass(
            $uses,
            $properties,
            $methods,
            $traits
        );
    }

    public function getUsesModelFactory(): UsesModelFactoryInterface
    {
        return $this->usesModelFactory;
    }

    public function getPropertiesModelFactory(): PropertiesModelFactoryInterface
    {
        return $this->propertiesModelFactory;
    }

    public function getMethodsModelFactory(): MethodsModelFactoryInterface
    {
        return $this->methodsModelFactory;
    }

    public function getTraitsModelFactory(): TraitsModelFactoryInterface
    {
        return $this->traitsModelFactory;
    }
}
