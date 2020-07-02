<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UseModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\UseModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\Methods;
use Prometee\PhpClassGenerator\Model\Other\Properties;
use Prometee\PhpClassGenerator\Model\Other\Traits;
use Prometee\PhpClassGenerator\Model\Other\Use_;
use Prometee\PhpClassGenerator\Model\Other\Uses;

trait OthersModelFactoryTrait
{
    /** @var PropertiesModelFactoryInterface */
    private $propertiesModelFactory;
    /** @var UsesModelFactoryInterface */
    private $usesModelFactory;
    /** @var UseModelFactoryInterface */
    private $useModelFactory;
    /** @var TraitsModelFactoryInterface */
    private $traitsModelFactory;
    /** @var MethodsModelFactoryInterface */
    private $methodsModelFactory;

    /** @var string */
    private $propertiesModelFactoryClass = PropertiesModelFactory::class;
    /** @var string */
    private $usesModelFactoryClass = UsesModelFactory::class;
    /** @var string */
    private $useModelFactoryClass = UseModelFactory::class;
    /** @var string */
    private $traitsModelFactoryClass = TraitsModelFactory::class;
    /** @var string */
    private $methodsModelFactoryClass = MethodsModelFactory::class;

    /** @var string */
    private $propertiesClass = Properties::class;
    /** @var string */
    private $usesClass = Uses::class;
    /** @var string */
    private $useClass = Use_::class;
    /** @var string */
    private $traitsClass = Traits::class;
    /** @var string */
    private $methodsClass = Methods::class;

    public function buildPropertiesModelFactory(): PropertiesModelFactoryInterface
    {
        if (null === $this->propertiesModelFactory) {
            $this->propertiesModelFactory = new $this->propertiesModelFactoryClass(
                $this->propertiesClass
            );
        }

        return $this->propertiesModelFactory;
    }

    public function buildUsesModelFactory(): UsesModelFactoryInterface
    {
        if (null === $this->usesModelFactory) {
            $this->usesModelFactory = new $this->usesModelFactoryClass(
                $this->usesClass,
                $this->buildUseModelFactory()
            );
        }

        return $this->usesModelFactory;
    }

    public function buildUseModelFactory(): UseModelFactoryInterface
    {
        if (null === $this->useModelFactory) {
            $this->useModelFactory = new $this->useModelFactoryClass(
                $this->useClass
            );
        }

        return $this->useModelFactory;
    }

    public function buildTraitsModelFactory(): TraitsModelFactoryInterface
    {
        if (null === $this->traitsModelFactory) {
            $this->traitsModelFactory = new $this->traitsModelFactoryClass(
                $this->traitsClass
            );
        }

        return $this->traitsModelFactory;
    }

    public function buildMethodsModelFactory(): MethodsModelFactoryInterface
    {
        if (null === $this->methodsModelFactory) {
            $this->methodsModelFactory = new $this->methodsModelFactoryClass(
                $this->methodsClass
            );
        }

        return $this->methodsModelFactory;
    }

    public function getPropertiesModelFactoryClass(): string
    {
        return $this->propertiesModelFactoryClass;
    }

    public function setPropertiesModelFactoryClass(string $propertiesModelFactoryClass): void
    {
        $this->propertiesModelFactoryClass = $propertiesModelFactoryClass;
    }

    public function getUsesModelFactoryClass(): string
    {
        return $this->usesModelFactoryClass;
    }

    public function setUsesModelFactoryClass(string $usesModelFactoryClass): void
    {
        $this->usesModelFactoryClass = $usesModelFactoryClass;
    }

    public function getUseModelFactoryClass(): string
    {
        return $this->useModelFactoryClass;
    }

    public function setUseModelFactoryClass(string $useModelFactoryClass): void
    {
        $this->useModelFactoryClass = $useModelFactoryClass;
    }

    public function getTraitsModelFactoryClass(): string
    {
        return $this->traitsModelFactoryClass;
    }

    public function setTraitsModelFactoryClass(string $traitsModelFactoryClass): void
    {
        $this->traitsModelFactoryClass = $traitsModelFactoryClass;
    }

    public function getMethodsModelFactoryClass(): string
    {
        return $this->methodsModelFactoryClass;
    }

    public function setMethodsModelFactoryClass(string $methodsModelFactoryClass): void
    {
        $this->methodsModelFactoryClass = $methodsModelFactoryClass;
    }

    public function getPropertiesClass(): string
    {
        return $this->propertiesClass;
    }

    public function setPropertiesClass(string $propertiesClass): void
    {
        $this->propertiesClass = $propertiesClass;
    }

    public function getUsesClass(): string
    {
        return $this->usesClass;
    }

    public function setUsesClass(string $usesClass): void
    {
        $this->usesClass = $usesClass;
    }

    public function getUseClass(): string
    {
        return $this->useClass;
    }

    public function setUseClass(string $useClass): void
    {
        $this->useClass = $useClass;
    }

    public function getTraitsClass(): string
    {
        return $this->traitsClass;
    }

    public function setTraitsClass(string $traitsClass): void
    {
        $this->traitsClass = $traitsClass;
    }

    public function getMethodsClass(): string
    {
        return $this->methodsClass;
    }

    public function setMethodsClass(string $methodsClass): void
    {
        $this->methodsClass = $methodsClass;
    }
}