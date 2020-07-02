<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Class_\ClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\ClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\Class_;

trait ClassModelFactoryTrait
{
    /** @var ClassModelFactoryInterface */
    private $classModelFactory;

    /** @var string */
    private $classModelFactoryClass = ClassModelFactory::class;

    /** @var string */
    private $classModelClass = Class_::class;

    abstract public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface;
    abstract public function buildUsesModelFactory(): UsesModelFactoryInterface;
    abstract public function buildPropertiesModelFactory(): PropertiesModelFactoryInterface;
    abstract public function buildMethodsModelFactory(): MethodsModelFactoryInterface;
    abstract public function buildTraitsModelFactory(): TraitsModelFactoryInterface;

    public function buildClassModelFactory(): ClassModelFactoryInterface
    {
        if (null === $this->classModelFactory) {
            $this->classModelFactory = new $this->classModelFactoryClass(
                $this->classModelClass,
                $this->buildPhpDocModelFactory(),
                $this->buildUsesModelFactory(),
                $this->buildPropertiesModelFactory(),
                $this->buildMethodsModelFactory(),
                $this->buildTraitsModelFactory()
            );
        }

        return $this->classModelFactory;
    }

    public function getClassModelFactoryClass(): string
    {
        return $this->classModelFactoryClass;
    }

    public function setClassModelFactoryClass(string $classModelFactoryClass): void
    {
        $this->classModelFactoryClass = $classModelFactoryClass;
    }

    public function getClassModelClass(): string
    {
        return $this->classModelClass;
    }

    public function setClassModelClass(string $classModelClass): void
    {
        $this->classModelClass = $classModelClass;
    }
}
