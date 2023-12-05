<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<ClassInterface> $modelClass */
final class ClassModelFactory extends AbstractModelFactory implements ClassModelFactoryInterface
{
    /**
     * @param class-string<ClassInterface> $modelClass
     */
    public function __construct(
        string $modelClass,
        protected PhpDocModelFactoryInterface $phpDocModelFactory,
        protected AttributeModelFactoryInterface $attributeModelFactory,
        protected UsesModelFactoryInterface $usesModelFactory,
        protected PropertiesModelFactoryInterface $propertiesModelFactory,
        protected MethodsModelFactoryInterface $methodsModelFactory,
        protected TraitsModelFactoryInterface $traitsModelFactory
    ) {
        parent::__construct($modelClass);
    }

    public function create(?UsesInterface $uses = null): ClassInterface
    {
        $uses = $uses ?? $this->usesModelFactory->create();

        return new $this->modelClass(
            $uses,
            $this->phpDocModelFactory->create(),
            $this->attributeModelFactory->create(),
            $this->propertiesModelFactory->create($uses),
            $this->methodsModelFactory->create($uses),
            $this->traitsModelFactory->create($uses)
        );
    }

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        return $this->phpDocModelFactory;
    }

    public function getAttributeModelFactory(): AttributeModelFactoryInterface
    {
        return $this->attributeModelFactory;
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
