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
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\Properties;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\Traits;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\Use_;
use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\Model\Other\Uses;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

trait OthersModelFactoryTrait
{
    private ?PropertiesModelFactoryInterface $propertiesModelFactory = null;
    private ?UsesModelFactoryInterface $usesModelFactory = null;
    private ?UseModelFactoryInterface $useModelFactory = null;
    private ?TraitsModelFactoryInterface $traitsModelFactory = null;
    private ?MethodsModelFactoryInterface $methodsModelFactory = null;

    /** @var class-string<PropertiesModelFactoryInterface> */
    private string $propertiesModelFactoryClass = PropertiesModelFactory::class;
    /** @var class-string<UsesModelFactoryInterface> */
    private string $usesModelFactoryClass = UsesModelFactory::class;
    /** @var class-string<UseModelFactoryInterface> */
    private string $useModelFactoryClass = UseModelFactory::class;
    /** @var class-string<TraitsModelFactoryInterface> */
    private string $traitsModelFactoryClass = TraitsModelFactory::class;
    /** @var class-string<MethodsModelFactoryInterface> */
    private string $methodsModelFactoryClass = MethodsModelFactory::class;

    /** @var class-string<PropertiesInterface> */
    private string $propertiesClass = Properties::class;
    /** @var class-string<UsesInterface> */
    private string $usesClass = Uses::class;
    /** @var class-string<UseInterface> */
    private string $useClass = Use_::class;
    /** @var class-string<TraitsInterface> */
    private string $traitsClass = Traits::class;
    /** @var class-string<MethodsInterface> */
    private string $methodsClass = Methods::class;

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
