<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;

final class ClassModelFactory extends AbstractModelFactory implements ClassModelFactoryInterface
{
    /** @var UsesModelFactoryInterface */
    protected $usesModelFactory;
    /** @var PhpDocModelFactoryInterface */
    protected $phpDocModelFactory;
    /** @var PropertiesModelFactoryInterface */
    protected $propertiesModelFactory;
    /** @var MethodsModelFactoryInterface */
    protected $methodsModelFactory;
    /** @var TraitsModelFactoryInterface */
    protected $traitsModelFactory;

    public function __construct(
        string $modelClass,
        PhpDocModelFactoryInterface $phpDocModelFactory,
        UsesModelFactoryInterface $usesModelFactory,
        PropertiesModelFactoryInterface $propertiesModelFactory,
        MethodsModelFactoryInterface $methodsModelFactory,
        TraitsModelFactoryInterface $traitsModelFactory
    ) {
        parent::__construct($modelClass);
        $this->phpDocModelFactory = $phpDocModelFactory;
        $this->usesModelFactory = $usesModelFactory;
        $this->propertiesModelFactory = $propertiesModelFactory;
        $this->methodsModelFactory = $methodsModelFactory;
        $this->traitsModelFactory = $traitsModelFactory;
    }

    public function create(): ClassInterface
    {
        $uses = $this->usesModelFactory->create();

        return new $this->modelClass(
            $uses,
            $this->phpDocModelFactory->create(),
            $this->propertiesModelFactory->create($uses),
            $this->methodsModelFactory->create($uses),
            $this->traitsModelFactory->create($uses)
        );
    }

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        return $this->phpDocModelFactory;
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
