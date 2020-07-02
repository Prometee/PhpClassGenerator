<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Method\ArrayGetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\ArrayGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\ArrayGetterSetter;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetter;
use Prometee\PhpClassGenerator\Model\Method\GetterSetter;
use Prometee\PhpClassGenerator\Model\Method\IsserSetter;

trait GetterSettersModelFactoryTrait
{
    /** @var GetterSetterModelFactoryInterface */
    private $getterSetterModelFactory;
    /** @var ArrayGetterSetterModelFactoryInterface */
    private $arrayGetterSetterModelFactory;
    /** @var IsserSetterModelFactoryInterface */
    private $isserSetterModelFactory;
    /** @var AutoGetterSetterModelFactoryInterface */
    private $autoGetterSetterModelFactory;

    /** @var string */
    private $getterSetterModelFactoryClass = GetterSetterModelFactory::class;
    /** @var string */
    private $arrayGetterSetterModelFactoryClass = ArrayGetterSetterModelFactory::class;
    /** @var string */
    private $isserSetterModelFactoryClass = IsserSetterModelFactory::class;
    /** @var string */
    private $autoGetterSetterModelFactoryClass = AutoGetterSetterModelFactory::class;

    /** @var string */
    private $getterSetterClass = GetterSetter::class;
    /** @var string */
    private $arrayGetterSetterClass = ArrayGetterSetter::class;
    /** @var string */
    private $isserSetterClass = IsserSetter::class;
    /** @var string */
    private $autoGetterSetterClass = AutoGetterSetter::class;

    abstract public function buildMethodModelFactory(): MethodModelFactoryInterface;
    abstract public function buildMethodParameterModelFactory(): MethodParameterModelFactoryInterface;

    public function buildGetterSetterModelFactory(): GetterSetterModelFactoryInterface
    {
        if (null === $this->getterSetterModelFactory) {
            $this->getterSetterModelFactory = new $this->getterSetterModelFactoryClass(
                $this->getterSetterClass,
                $this->buildMethodModelFactory(),
                $this->buildMethodParameterModelFactory()
            );
        }

        return $this->getterSetterModelFactory;
    }


    public function buildArrayGetterSetterModelFactory(): ArrayGetterSetterModelFactoryInterface
    {
        if (null === $this->arrayGetterSetterModelFactory) {
            $this->arrayGetterSetterModelFactory = new $this->arrayGetterSetterModelFactoryClass(
                $this->arrayGetterSetterClass,
                $this->buildGetterSetterModelFactory()
            );
        }

        return $this->arrayGetterSetterModelFactory;
    }

    public function buildIsserSetterModelFactory(): IsserSetterModelFactoryInterface
    {
        if (null === $this->isserSetterModelFactory) {
            $this->isserSetterModelFactory = new $this->isserSetterModelFactoryClass(
                $this->isserSetterClass,
                $this->buildGetterSetterModelFactory()
            );
        }

        return $this->isserSetterModelFactory;
    }

    public function buildAutoGetterSetterModelFactory(): AutoGetterSetterModelFactoryInterface
    {
        if (null === $this->autoGetterSetterModelFactory) {
            $this->autoGetterSetterModelFactory = new $this->autoGetterSetterModelFactoryClass(
                $this->autoGetterSetterClass,
                $this->buildArrayGetterSetterModelFactory(),
                $this->buildIsserSetterModelFactory(),
                $this->buildGetterSetterModelFactory()
            );
        }

        return $this->autoGetterSetterModelFactory;
    }


    public function getGetterSetterModelFactoryClass(): string
    {
        return $this->getterSetterModelFactoryClass;
    }

    public function setGetterSetterModelFactoryClass(string $getterSetterModelFactoryClass): void
    {
        $this->getterSetterModelFactoryClass = $getterSetterModelFactoryClass;
    }


    public function getArrayGetterSetterModelFactoryClass(): string
    {
        return $this->arrayGetterSetterModelFactoryClass;
    }

    public function setArrayGetterSetterModelFactoryClass(string $arrayGetterSetterModelFactoryClass): void
    {
        $this->arrayGetterSetterModelFactoryClass = $arrayGetterSetterModelFactoryClass;
    }

    public function getIsserSetterModelFactoryClass(): string
    {
        return $this->isserSetterModelFactoryClass;
    }

    public function setIsserSetterModelFactoryClass(string $isserSetterModelFactoryClass): void
    {
        $this->isserSetterModelFactoryClass = $isserSetterModelFactoryClass;
    }

    public function getAutoGetterSetterModelFactoryClass(): string
    {
        return $this->autoGetterSetterModelFactoryClass;
    }

    public function setAutoGetterSetterModelFactoryClass(string $autoGetterSetterModelFactoryClass): void
    {
        $this->autoGetterSetterModelFactoryClass = $autoGetterSetterModelFactoryClass;
    }


    public function getGetterSetterClass(): string
    {
        return $this->getterSetterClass;
    }

    public function setGetterSetterClass(string $getterSetterClass): void
    {
        $this->getterSetterClass = $getterSetterClass;
    }


    public function getArrayGetterSetterClass(): string
    {
        return $this->arrayGetterSetterClass;
    }

    public function setArrayGetterSetterClass(string $arrayGetterSetterClass): void
    {
        $this->arrayGetterSetterClass = $arrayGetterSetterClass;
    }

    public function getIsserSetterClass(): string
    {
        return $this->isserSetterClass;
    }

    public function setIsserSetterClass(string $isserSetterClass): void
    {
        $this->isserSetterClass = $isserSetterClass;
    }

    public function getAutoGetterSetterClass(): string
    {
        return $this->autoGetterSetterClass;
    }

    public function setAutoGetterSetterClass(string $autoGetterSetterClass): void
    {
        $this->autoGetterSetterClass = $autoGetterSetterClass;
    }
}