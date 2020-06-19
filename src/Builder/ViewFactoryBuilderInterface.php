<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Factory\View\Attribute\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\ClassView\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;

interface ViewFactoryBuilderInterface
{
    public function buildTraitsViewFactory(): TraitsViewFactoryInterface;

    public function getMethodParameterViewFactoryClass(): string;

    public function setUsesViewClass(string $usesViewClass): void;

    public function setPropertyViewClass(string $propertyViewClass): void;

    public function setClassViewClass(string $classViewClass): void;

    public function getUsesViewClass(): string;

    public function getPropertyViewFactoryClass(): string;

    public function buildPropertiesViewFactory(): PropertiesViewFactoryInterface;

    public function getClassViewFactoryClass(): string;

    public function setMethodViewFactoryClass(string $methodViewFactoryClass): void;

    public function setMethodParameterViewFactoryClass(string $methodParameterViewFactoryClass): void;

    public function getPropertiesViewClass(): string;

    public function setClassViewFactoryClass(string $classViewFactoryClass): void;

    public function getMethodParameterViewClass(): string;

    public function setMethodsViewFactoryClass(string $methodsViewFactoryClass): void;

    public function setPropertyViewFactoryClass(string $propertyViewFactoryClass): void;

    public function getMethodViewFactoryClass(): string;

    public function getPhpDocViewClass(): string;

    public function buildUsesViewFactory(): UsesViewFactoryInterface;

    public function setMethodViewClass(string $methodViewClass): void;

    public function setPhpDocViewFactoryClass(string $phpDocViewFactoryClass): void;

    public function setTraitsViewClass(string $traitsViewClass): void;

    public function getMethodsViewClass(): string;

    public function setUsesViewFactoryClass(string $usesViewFactoryClass): void;

    public function setTraitsViewFactoryClass(string $traitsViewFactoryClass): void;

    public function setPropertiesViewFactoryClass(string $propertiesViewFactoryClass): void;

    public function getPropertyViewClass(): string;

    public function getPropertiesViewFactoryClass(): string;

    public function getPhpDocViewFactoryClass(): string;

    public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface;

    public function setMethodsViewClass(string $methodsViewClass): void;

    public function getTraitsViewFactoryClass(): string;

    public function getUsesViewFactoryClass(): string;

    public function buildMethodViewFactory(): MethodViewFactoryInterface;

    public function setPhpDocViewClass(string $phpDocViewClass): void;

    public function setMethodParameterViewClass(string $methodParameterViewClass): void;

    public function getMethodsViewFactoryClass(): string;

    public function getClassViewClass(): string;

    public function getMethodViewClass(): string;

    public function setPropertiesViewClass(string $propertiesViewClass): void;

    public function buildPropertyViewFactory(): PropertyViewFactoryInterface;

    public function buildMethodsViewFactory(): MethodsViewFactoryInterface;

    public function getTraitsViewClass(): string;

    public function buildMethodParameterViewFactory(): MethodParameterViewFactoryInterface;

    public function buildClassViewFactory(): ClassViewFactoryInterface;

    public function getWrapOn(): int;

    public function setWrapOn(int $wrapOn): void;
}
