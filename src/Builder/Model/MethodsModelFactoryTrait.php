<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\Constructor;
use Prometee\PhpClassGenerator\Model\Method\Method;
use Prometee\PhpClassGenerator\Model\Method\MethodParameter;

trait MethodsModelFactoryTrait
{
    /** @var MethodModelFactoryInterface */
    private $methodModelFactory;
    /** @var MethodParameterModelFactoryInterface */
    private $methodParameterModelFactory;
    /** @var ConstructorModelFactoryInterface */
    private $constructorModelFactory;

    /** @var string */
    private $methodModelFactoryClass = MethodModelFactory::class;
    /** @var string */
    private $methodParameterModelFactoryClass = MethodParameterModelFactory::class;
    /** @var string */
    private $constructorModelFactoryClass = ConstructorModelFactory::class;

    /** @var string */
    private $methodClass = Method::class;
    /** @var string */
    private $methodParameterClass = MethodParameter::class;
    /** @var string */
    private $constructorClass = Constructor::class;

    abstract public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function buildMethodModelFactory(): MethodModelFactoryInterface
    {
        if (null === $this->methodModelFactory) {
            $this->methodModelFactory = new $this->methodModelFactoryClass(
                $this->methodClass,
                $this->buildPhpDocModelFactory()
            );
        }

        return $this->methodModelFactory;
    }

    public function buildMethodParameterModelFactory(): MethodParameterModelFactoryInterface
    {
        if (null === $this->methodParameterModelFactory) {
            $this->methodParameterModelFactory = new $this->methodParameterModelFactoryClass(
                $this->methodParameterClass
            );
        }

        return $this->methodParameterModelFactory;
    }

    public function buildConstructorModelFactory(): ConstructorModelFactoryInterface
    {
        if (null === $this->constructorModelFactory) {
            $this->constructorModelFactory = new $this->constructorModelFactoryClass(
                $this->constructorClass,
                $this->buildMethodModelFactory()
            );
        }

        return $this->constructorModelFactory;
    }

    public function getMethodModelFactoryClass(): string
    {
        return $this->methodModelFactoryClass;
    }

    public function setMethodModelFactoryClass(string $methodModelFactoryClass): void
    {
        $this->methodModelFactoryClass = $methodModelFactoryClass;
    }

    public function getMethodParameterModelFactoryClass(): string
    {
        return $this->methodParameterModelFactoryClass;
    }

    public function setMethodParameterModelFactoryClass(string $methodParameterModelFactoryClass): void
    {
        $this->methodParameterModelFactoryClass = $methodParameterModelFactoryClass;
    }

    public function getConstructorModelFactoryClass(): string
    {
        return $this->constructorModelFactoryClass;
    }

    public function setConstructorModelFactoryClass(string $constructorModelFactoryClass): void
    {
        $this->constructorModelFactoryClass = $constructorModelFactoryClass;
    }

    public function getMethodClass(): string
    {
        return $this->methodClass;
    }

    public function setMethodClass(string $methodClass): void
    {
        $this->methodClass = $methodClass;
    }

    public function getMethodParameterClass(): string
    {
        return $this->methodParameterClass;
    }

    public function setMethodParameterClass(string $methodParameterClass): void
    {
        $this->methodParameterClass = $methodParameterClass;
    }

    public function getConstructorClass(): string
    {
        return $this->constructorClass;
    }

    public function setConstructorClass(string $constructorClass): void
    {
        $this->constructorClass = $constructorClass;
    }

}