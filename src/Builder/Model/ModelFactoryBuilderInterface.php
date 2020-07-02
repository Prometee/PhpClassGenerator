<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\Model;

use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactoryInterface;
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

interface ModelFactoryBuilderInterface
{
    public function buildMethodsModelFactory(): MethodsModelFactoryInterface;

    public function setTraitsModelFactoryClass(string $traitsModelFactoryClass): void;

    public function getGetterSetterClass(): string;

    public function getAbstractClassModelFactoryClass(): string;

    public function getUsesModelFactoryClass(): string;

    public function getUseModelFactoryClass(): string;

    public function buildTraitsModelFactory(): TraitsModelFactoryInterface;

    public function getAbstractClassClass(): string;

    public function getPropertiesClass(): string;

    public function setInterfaceClassModelFactoryClass(string $interfaceClassModelFactoryClass): void;

    public function buildAbstractClassModelFactory(): AbstractClassModelFactoryInterface;

    public function buildPropertyModelFactory(): PropertyModelFactoryInterface;

    public function getIsserSetterClass(): string;

    public function getArrayGetterSetterModelFactoryClass(): string;

    public function getMethodsClass(): string;

    public function getPropertyClass(): string;

    public function buildIsserSetterModelFactory(): IsserSetterModelFactoryInterface;

    public function getMethodParameterClass(): string;

    public function setClassModelFactoryClass(string $classModelFactoryClass): void;

    public function setConstructorClass(string $constructorClass): void;

    public function setAbstractClassClass(string $abstractClassClass): void;

    public function buildArrayGetterSetterModelFactory(): ArrayGetterSetterModelFactoryInterface;

    public function getConstructorClass(): string;

    public function setTraitsClass(string $traitsClass): void;

    public function setFinalClassClass(string $finalClassClass): void;

    public function setPhpDocClass(string $phpDocClass): void;

    public function setPhpDocModelFactoryClass(string $phpDocModelFactoryClass): void;

    public function buildUsesModelFactory(): UsesModelFactoryInterface;

    public function buildUseModelFactory(): UseModelFactoryInterface;

    public function getTraitsModelFactoryClass(): string;

    public function buildFinalClassModelFactory(): FinalClassModelFactoryInterface;

    public function getPhpDocClass(): string;

    public function getTraitClassModelFactoryClass(): string;

    public function setInterfaceClassClass(string $interfaceClassClass): void;

    public function getIsserSetterModelFactoryClass(): string;

    public function buildMethodParameterModelFactory(): MethodParameterModelFactoryInterface;

    public function setMethodsClass(string $methodsClass): void;

    public function getArrayGetterSetterClass(): string;

    public function buildInterfaceClassModelFactory(): InterfaceClassModelFactoryInterface;

    public function setClassModelClass(string $classModelClass): void;

    public function getConstructorModelFactoryClass(): string;

    public function buildConstantModelFactory(): ConstantModelFactoryInterface;

    public function setGetterSetterClass(string $getterSetterClass): void;

    public function setTraitClassModelFactoryClass(string $traitClassModelFactoryClass): void;

    public function buildTraitClassModelFactory(): TraitClassModelFactoryInterface;

    public function setAbstractClassModelFactoryClass(string $abstractClassModelFactoryClass): void;

    public function getClassModelClass(): string;

    public function getConstantModelFactoryClass(): string;

    public function setArrayGetterSetterClass(string $arrayGetterSetterClass): void;

    public function getMethodModelFactoryClass(): string;

    public function setFinalClassModelFactoryClass(string $finalClassModelFactoryClass): void;

    public function setArrayGetterSetterModelFactoryClass(string $arrayGetterSetterModelFactoryClass): void;

    public function getMethodParameterModelFactoryClass(): string;

    public function setConstantModelFactoryClass(string $constantModelFactoryClass): void;

    public function getGetterSetterModelFactoryClass(): string;

    public function setPropertiesModelFactoryClass(string $propertiesModelFactoryClass): void;

    public function getConstantClass(): string;

    public function getUsesClass(): string;

    public function getUseClass(): string;

    public function setMethodsModelFactoryClass(string $methodsModelFactoryClass): void;

    public function setPropertiesClass(string $propertiesClass): void;

    public function setMethodParameterModelFactoryClass(string $methodParameterModelFactoryClass): void;

    public function getFinalClassModelFactoryClass(): string;

    public function buildGetterSetterModelFactory(): GetterSetterModelFactoryInterface;

    public function buildPropertiesModelFactory(): PropertiesModelFactoryInterface;

    public function getPropertiesModelFactoryClass(): string;

    public function setUsesClass(string $usesClass): void;

    public function setUseClass(string $useClass): void;

    public function getInterfaceClassModelFactoryClass(): string;

    public function getClassModelFactoryClass(): string;

    public function buildConstructorModelFactory(): ConstructorModelFactoryInterface;

    public function getMethodsModelFactoryClass(): string;

    public function setMethodModelFactoryClass(string $methodModelFactoryClass): void;

    public function setIsserSetterModelFactoryClass(string $isserSetterModelFactoryClass): void;

    public function setConstantClass(string $constantClass): void;

    public function getPhpDocModelFactoryClass(): string;

    public function setMethodParameterClass(string $methodParameterClass): void;

    public function setTraitClassClass(string $traitClassClass): void;

    public function getFinalClassClass(): string;

    public function setConstructorModelFactoryClass(string $constructorModelFactoryClass): void;

    public function setPropertyModelFactoryClass(string $propertyModelFactoryClass): void;

    public function getMethodClass(): string;

    public function getTraitClassClass(): string;

    public function setGetterSetterModelFactoryClass(string $getterSetterModelFactoryClass): void;

    public function setMethodClass(string $methodClass): void;

    public function getPropertyModelFactoryClass(): string;

    public function buildMethodModelFactory(): MethodModelFactoryInterface;

    public function setUsesModelFactoryClass(string $usesModelFactoryClass): void;

    public function setUseModelFactoryClass(string $useModelFactoryClass): void;

    public function setIsserSetterClass(string $isserSetterClass): void;

    public function buildClassModelFactory(): ClassModelFactoryInterface;

    public function getTraitsClass(): string;

    public function getInterfaceClassClass(): string;

    public function setPropertyClass(string $propertyClass): void;

    public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function buildAutoGetterSetterModelFactory(): AutoGetterSetterModelFactoryInterface;
    public function getAutoGetterSetterModelFactoryClass(): string;
    public function setAutoGetterSetterModelFactoryClass(string $autoGetterSetterModelFactoryClass): void;
    public function getAutoGetterSetterClass(): string;
    public function setAutoGetterSetterClass(string $autoGetterSetterClass): void;
}
