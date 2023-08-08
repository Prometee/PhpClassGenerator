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
use Prometee\PhpClassGenerator\Model\Method\ArrayGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetter;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\GetterSetter;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\IsserSetter;
use Prometee\PhpClassGenerator\Model\Method\IsserSetterInterface;

trait GetterSettersModelFactoryTrait
{
    private ?GetterSetterModelFactoryInterface $getterSetterModelFactory = null;
    private ?ArrayGetterSetterModelFactoryInterface $arrayGetterSetterModelFactory = null;
    private ?IsserSetterModelFactoryInterface $isserSetterModelFactory = null;
    private ?AutoGetterSetterModelFactoryInterface $autoGetterSetterModelFactory = null;

    /** @var class-string<GetterSetterModelFactoryInterface> */
    private string $getterSetterModelFactoryClass = GetterSetterModelFactory::class;
    /** @var class-string<ArrayGetterSetterModelFactoryInterface> */
    private string $arrayGetterSetterModelFactoryClass = ArrayGetterSetterModelFactory::class;
    /** @var class-string<IsserSetterModelFactoryInterface> */
    private string $isserSetterModelFactoryClass = IsserSetterModelFactory::class;
    /** @var class-string<AutoGetterSetterModelFactoryInterface> */
    private string $autoGetterSetterModelFactoryClass = AutoGetterSetterModelFactory::class;

    /** @var class-string<GetterSetterInterface> */
    private string $getterSetterClass = GetterSetter::class;
    /** @var class-string<ArrayGetterSetterInterface> */
    private string $arrayGetterSetterClass = ArrayGetterSetter::class;
    /** @var class-string<IsserSetterInterface> */
    private string $isserSetterClass = IsserSetter::class;
    /** @var class-string<AutoGetterSetterInterface> */
    private string $autoGetterSetterClass = AutoGetterSetter::class;

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
