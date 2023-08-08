<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Class_\AbstractClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\ClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\FinalClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\InterfaceClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\TraitClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ArrayGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UseModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\FinalClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\InterfaceClassInterface;
use Prometee\PhpClassGenerator\Model\Class_\TraitClassInterface;
use Prometee\PhpClassGenerator\Model\Method\ArrayGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\ConstructorInterface;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\IsserSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

interface ModelFactoryBuilderInterface
{
    public function buildMethodsModelFactory(): MethodsModelFactoryInterface;

    /** @param class-string<TraitsModelFactoryInterface> $traitsModelFactoryClass */
    public function setTraitsModelFactoryClass(string $traitsModelFactoryClass): void;

    public function getGetterSetterClass(): string;

    public function getAbstractClassModelFactoryClass(): string;

    public function getUsesModelFactoryClass(): string;

    public function getUseModelFactoryClass(): string;

    public function buildTraitsModelFactory(): TraitsModelFactoryInterface;

    public function getAbstractClassClass(): string;

    public function getPropertiesClass(): string;

    /** @param class-string<InterfaceClassModelFactoryInterface> $interfaceClassModelFactoryClass */
    public function setInterfaceClassModelFactoryClass(string $interfaceClassModelFactoryClass): void;

    public function buildAbstractClassModelFactory(): AbstractClassModelFactoryInterface;

    public function buildPropertyModelFactory(): PropertyModelFactoryInterface;

    public function getIsserSetterClass(): string;

    public function getArrayGetterSetterModelFactoryClass(): string;

    public function getMethodsClass(): string;

    public function getPropertyClass(): string;

    public function buildIsserSetterModelFactory(): IsserSetterModelFactoryInterface;

    public function getMethodParameterClass(): string;

    /** @param class-string<ClassModelFactoryInterface> $classModelFactoryClass */
    public function setClassModelFactoryClass(string $classModelFactoryClass): void;

    /** @param class-string<ConstructorInterface> $constructorClass */
    public function setConstructorClass(string $constructorClass): void;

    /** @param class-string<AbstractClassInterface> $abstractClassClass */
    public function setAbstractClassClass(string $abstractClassClass): void;

    public function buildArrayGetterSetterModelFactory(): ArrayGetterSetterModelFactoryInterface;

    public function getConstructorClass(): string;

    /** @param class-string<TraitsInterface> $traitsClass */
    public function setTraitsClass(string $traitsClass): void;

    /** @param class-string<FinalClassInterface> $finalClassClass */
    public function setFinalClassClass(string $finalClassClass): void;

    /** @param class-string<PhpDocInterface> $phpDocClass */
    public function setPhpDocClass(string $phpDocClass): void;

    /** @param class-string<PhpDocModelFactoryInterface> $phpDocModelFactoryClass */
    public function setPhpDocModelFactoryClass(string $phpDocModelFactoryClass): void;

    public function buildUsesModelFactory(): UsesModelFactoryInterface;

    public function buildUseModelFactory(): UseModelFactoryInterface;

    public function getTraitsModelFactoryClass(): string;

    public function buildFinalClassModelFactory(): FinalClassModelFactoryInterface;

    public function getPhpDocClass(): string;

    public function getTraitClassModelFactoryClass(): string;

    /** @param class-string<InterfaceClassInterface> $interfaceClassClass */
    public function setInterfaceClassClass(string $interfaceClassClass): void;

    public function getIsserSetterModelFactoryClass(): string;

    public function buildMethodParameterModelFactory(): MethodParameterModelFactoryInterface;

    /** @param class-string<MethodsInterface> $methodsClass */
    public function setMethodsClass(string $methodsClass): void;

    public function getArrayGetterSetterClass(): string;

    public function buildInterfaceClassModelFactory(): InterfaceClassModelFactoryInterface;

    /** @param class-string<ClassModelFactoryInterface> $classModelClass */
    public function setClassModelClass(string $classModelClass): void;

    public function getConstructorModelFactoryClass(): string;

    public function buildConstantModelFactory(): ConstantModelFactoryInterface;

    /** @param class-string<GetterSetterInterface> $getterSetterClass */
    public function setGetterSetterClass(string $getterSetterClass): void;

    /** @param class-string<TraitClassModelFactoryInterface> $traitClassModelFactoryClass */
    public function setTraitClassModelFactoryClass(string $traitClassModelFactoryClass): void;

    public function buildTraitClassModelFactory(): TraitClassModelFactoryInterface;

    /** @param class-string<AbstractClassModelFactoryInterface> $abstractClassModelFactoryClass */
    public function setAbstractClassModelFactoryClass(string $abstractClassModelFactoryClass): void;

    public function getClassModelClass(): string;

    public function getConstantModelFactoryClass(): string;

    /** @param class-string<ArrayGetterSetterInterface> $arrayGetterSetterClass */
    public function setArrayGetterSetterClass(string $arrayGetterSetterClass): void;

    public function getMethodModelFactoryClass(): string;

    /** @param class-string<FinalClassModelFactoryInterface> $finalClassModelFactoryClass */
    public function setFinalClassModelFactoryClass(string $finalClassModelFactoryClass): void;

    /** @param class-string<ArrayGetterSetterModelFactoryInterface> $arrayGetterSetterModelFactoryClass */
    public function setArrayGetterSetterModelFactoryClass(string $arrayGetterSetterModelFactoryClass): void;

    public function getMethodParameterModelFactoryClass(): string;

    /** @param class-string<ConstantModelFactoryInterface> $constantModelFactoryClass */
    public function setConstantModelFactoryClass(string $constantModelFactoryClass): void;

    public function getGetterSetterModelFactoryClass(): string;

    /** @param class-string<PropertiesModelFactoryInterface> $propertiesModelFactoryClass */
    public function setPropertiesModelFactoryClass(string $propertiesModelFactoryClass): void;

    public function getConstantClass(): string;

    public function getUsesClass(): string;

    public function getUseClass(): string;

    /** @param class-string<MethodsModelFactoryInterface> $methodsModelFactoryClass */
    public function setMethodsModelFactoryClass(string $methodsModelFactoryClass): void;

    /** @param class-string<PropertiesInterface> $propertiesClass */
    public function setPropertiesClass(string $propertiesClass): void;

    /** @param class-string<MethodParameterModelFactoryInterface> $methodParameterModelFactoryClass */
    public function setMethodParameterModelFactoryClass(string $methodParameterModelFactoryClass): void;

    public function getFinalClassModelFactoryClass(): string;

    public function buildGetterSetterModelFactory(): GetterSetterModelFactoryInterface;

    public function buildPropertiesModelFactory(): PropertiesModelFactoryInterface;

    public function getPropertiesModelFactoryClass(): string;

    /** @param class-string<UsesInterface> $usesClass */
    public function setUsesClass(string $usesClass): void;

    /** @param class-string<UseInterface> $useClass */
    public function setUseClass(string $useClass): void;

    public function getInterfaceClassModelFactoryClass(): string;

    public function getClassModelFactoryClass(): string;

    public function buildConstructorModelFactory(): ConstructorModelFactoryInterface;

    public function getMethodsModelFactoryClass(): string;

    /** @param class-string<MethodModelFactoryInterface> $methodModelFactoryClass */
    public function setMethodModelFactoryClass(string $methodModelFactoryClass): void;

    /** @param class-string<IsserSetterModelFactoryInterface> $isserSetterModelFactoryClass */
    public function setIsserSetterModelFactoryClass(string $isserSetterModelFactoryClass): void;

    /** @param class-string<ConstantInterface> $constantClass */
    public function setConstantClass(string $constantClass): void;

    public function getPhpDocModelFactoryClass(): string;

    /** @param class-string<MethodParameterInterface> $methodParameterClass */
    public function setMethodParameterClass(string $methodParameterClass): void;

    /** @param class-string<TraitClassInterface> $traitClassClass */
    public function setTraitClassClass(string $traitClassClass): void;

    public function getFinalClassClass(): string;

    /** @param class-string<ConstructorModelFactoryInterface> $constructorModelFactoryClass */
    public function setConstructorModelFactoryClass(string $constructorModelFactoryClass): void;

    /** @param class-string<PropertyModelFactoryInterface> $propertyModelFactoryClass */
    public function setPropertyModelFactoryClass(string $propertyModelFactoryClass): void;

    public function getMethodClass(): string;

    public function getTraitClassClass(): string;

    /** @param class-string<GetterSetterModelFactoryInterface> $getterSetterModelFactoryClass */
    public function setGetterSetterModelFactoryClass(string $getterSetterModelFactoryClass): void;

    /** @param class-string<MethodInterface> $methodClass */
    public function setMethodClass(string $methodClass): void;

    public function getPropertyModelFactoryClass(): string;

    public function buildMethodModelFactory(): MethodModelFactoryInterface;

    /** @param class-string<UsesModelFactoryInterface> $usesModelFactoryClass */
    public function setUsesModelFactoryClass(string $usesModelFactoryClass): void;

    /** @param class-string<UseModelFactoryInterface> $useModelFactoryClass */
    public function setUseModelFactoryClass(string $useModelFactoryClass): void;

    /** @param class-string<IsserSetterInterface> $isserSetterClass */
    public function setIsserSetterClass(string $isserSetterClass): void;

    public function buildClassModelFactory(): ClassModelFactoryInterface;

    public function getTraitsClass(): string;

    public function getInterfaceClassClass(): string;

    /** @param class-string<PropertyInterface> $propertyClass */
    public function setPropertyClass(string $propertyClass): void;

    public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function buildAutoGetterSetterModelFactory(): AutoGetterSetterModelFactoryInterface;
    public function getAutoGetterSetterModelFactoryClass(): string;
    /** @param class-string<AutoGetterSetterModelFactoryInterface> $autoGetterSetterModelFactoryClass */
    public function setAutoGetterSetterModelFactoryClass(string $autoGetterSetterModelFactoryClass): void;
    public function getAutoGetterSetterClass(): string;
    /** @param class-string<AutoGetterSetterInterface> $autoGetterSetterClass */
    public function setAutoGetterSetterClass(string $autoGetterSetterClass): void;
}
