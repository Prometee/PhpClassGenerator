<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\Attribute\AttributeViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodParameterViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Method\MethodViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\MethodsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\PropertiesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\TraitsViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UsesViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Other\UseViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Attribute\AttributeViewInterface;
use Prometee\PhpClassGenerator\View\Class_\ClassViewInterface;
use Prometee\PhpClassGenerator\View\Method\MethodParameterViewInterface;
use Prometee\PhpClassGenerator\View\Method\MethodViewInterface;
use Prometee\PhpClassGenerator\View\Other\MethodsViewInterface;
use Prometee\PhpClassGenerator\View\Other\PropertiesViewInterface;
use Prometee\PhpClassGenerator\View\Other\TraitsViewInterface;
use Prometee\PhpClassGenerator\View\Other\UsesViewInterface;
use Prometee\PhpClassGenerator\View\Other\UseViewInterface;
use Prometee\PhpClassGenerator\View\PhpDoc\PhpDocViewInterface;
use Prometee\PhpClassGenerator\View\Property\PropertyViewInterface;

interface ViewFactoryBuilderInterface
{
    public function buildTraitsViewFactory(): TraitsViewFactoryInterface;

    public function getMethodParameterViewFactoryClass(): string;

    /** @param class-string<UsesViewInterface> $usesViewClass */
    public function setUsesViewClass(string $usesViewClass): void;

    /** @param class-string<UseViewInterface> $useViewClass */
    public function setUseViewClass(string $useViewClass): void;

    /** @param class-string<PropertyViewInterface> $propertyViewClass */
    public function setPropertyViewClass(string $propertyViewClass): void;

    /** @param class-string<ClassViewInterface> $classViewClass */
    public function setClassViewClass(string $classViewClass): void;

    public function getUsesViewClass(): string;

    public function getUseViewClass(): string;

    public function getPropertyViewFactoryClass(): string;

    public function buildPropertiesViewFactory(): PropertiesViewFactoryInterface;

    public function getClassViewFactoryClass(): string;

    /** @param class-string<MethodViewFactoryInterface> $methodViewFactoryClass */
    public function setMethodViewFactoryClass(string $methodViewFactoryClass): void;

    /** @param class-string<MethodParameterViewFactoryInterface> $methodParameterViewFactoryClass */
    public function setMethodParameterViewFactoryClass(string $methodParameterViewFactoryClass): void;

    public function getPropertiesViewClass(): string;

    /** @param class-string<ClassViewFactoryInterface> $classViewFactoryClass */
    public function setClassViewFactoryClass(string $classViewFactoryClass): void;

    public function getMethodParameterViewClass(): string;

    /** @param class-string<MethodsViewFactoryInterface> $methodsViewFactoryClass */
    public function setMethodsViewFactoryClass(string $methodsViewFactoryClass): void;

    /** @param class-string<PropertyViewFactoryInterface> $propertyViewFactoryClass */
    public function setPropertyViewFactoryClass(string $propertyViewFactoryClass): void;

    public function getMethodViewFactoryClass(): string;

    public function getPhpDocViewClass(): string;

    public function getAttributeViewClass(): string;

    public function buildUsesViewFactory(): UsesViewFactoryInterface;

    public function buildUseViewFactory(): UseViewFactoryInterface;

    /** @param class-string<MethodViewInterface> $methodViewClass */
    public function setMethodViewClass(string $methodViewClass): void;

    /** @param class-string<PhpDocViewFactoryInterface> $phpDocViewFactoryClass */
    public function setPhpDocViewFactoryClass(string $phpDocViewFactoryClass): void;

    /** @param class-string<AttributeViewFactoryInterface> $attributeViewFactoryClass */
    public function setAttributeViewFactoryClass(string $attributeViewFactoryClass): void;

    /** @param class-string<TraitsViewInterface> $traitsViewClass */
    public function setTraitsViewClass(string $traitsViewClass): void;

    public function getMethodsViewClass(): string;

    /** @param class-string<UsesViewFactoryInterface> $usesViewFactoryClass */
    public function setUsesViewFactoryClass(string $usesViewFactoryClass): void;

    /** @param class-string<UseViewFactoryInterface> $useViewFactoryClass */
    public function setUseViewFactoryClass(string $useViewFactoryClass): void;

    /** @param class-string<TraitsViewFactoryInterface> $traitsViewFactoryClass */
    public function setTraitsViewFactoryClass(string $traitsViewFactoryClass): void;

    /** @param class-string<PropertiesViewFactoryInterface> $propertiesViewFactoryClass */
    public function setPropertiesViewFactoryClass(string $propertiesViewFactoryClass): void;

    public function getPropertyViewClass(): string;

    public function getPropertiesViewFactoryClass(): string;

    public function getPhpDocViewFactoryClass(): string;

    public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface;

    public function getAttributeViewFactoryClass(): string;

    public function buildAttributeViewFactory(): AttributeViewFactoryInterface;

    /** @param class-string<MethodsViewInterface> $methodsViewClass */
    public function setMethodsViewClass(string $methodsViewClass): void;

    public function getTraitsViewFactoryClass(): string;

    public function getUsesViewFactoryClass(): string;

    public function getUseViewFactoryClass(): string;

    public function buildMethodViewFactory(): MethodViewFactoryInterface;

    /** @param class-string<PhpDocViewInterface> $phpDocViewClass */
    public function setPhpDocViewClass(string $phpDocViewClass): void;

    /** @param class-string<AttributeViewInterface> $attributeViewClass */
    public function setAttributeViewClass(string $attributeViewClass): void;

    /** @param class-string<MethodParameterViewInterface> $methodParameterViewClass */
    public function setMethodParameterViewClass(string $methodParameterViewClass): void;

    public function getMethodsViewFactoryClass(): string;

    public function getClassViewClass(): string;

    public function getMethodViewClass(): string;

    /** @param class-string<PropertiesViewInterface> $propertiesViewClass */
    public function setPropertiesViewClass(string $propertiesViewClass): void;

    public function buildPropertyViewFactory(): PropertyViewFactoryInterface;

    public function buildMethodsViewFactory(): MethodsViewFactoryInterface;

    public function getTraitsViewClass(): string;

    public function buildMethodParameterViewFactory(): MethodParameterViewFactoryInterface;

    public function buildClassViewFactory(): ClassViewFactoryInterface;

    public function getWrapOn(): int;

    public function setWrapOn(int $wrapOn): void;
}
