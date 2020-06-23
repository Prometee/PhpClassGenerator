<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Factory\Model\Attribute\ConstantModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\PropertyModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Attribute\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\AbstractClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\AbstractClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\ClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\ClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\FinalClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\FinalClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\InterfaceClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\InterfaceClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Class_\TraitClassModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Class_\TraitClassModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ArrayGetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\ArrayGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\GetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\IsserSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
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
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactory;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\Constant;
use Prometee\PhpClassGenerator\Model\Attribute\Property;
use Prometee\PhpClassGenerator\Model\Class_\AbstractClass;
use Prometee\PhpClassGenerator\Model\Class_\Class_;
use Prometee\PhpClassGenerator\Model\Class_\FinalClass;
use Prometee\PhpClassGenerator\Model\Class_\InterfaceClass;
use Prometee\PhpClassGenerator\Model\Class_\TraitClass;
use Prometee\PhpClassGenerator\Model\Method\ArrayGetterSetter;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetter;
use Prometee\PhpClassGenerator\Model\Method\Constructor;
use Prometee\PhpClassGenerator\Model\Method\GetterSetter;
use Prometee\PhpClassGenerator\Model\Method\IsserSetter;
use Prometee\PhpClassGenerator\Model\Method\Method;
use Prometee\PhpClassGenerator\Model\Method\MethodParameter;
use Prometee\PhpClassGenerator\Model\Other\Methods;
use Prometee\PhpClassGenerator\Model\Other\Properties;
use Prometee\PhpClassGenerator\Model\Other\Traits;
use Prometee\PhpClassGenerator\Model\Other\Use_;
use Prometee\PhpClassGenerator\Model\Other\Uses;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDoc;

final class ModelFactoryBuilder implements ModelFactoryBuilderInterface
{
    /** @var PhpDocModelFactoryInterface */
    private $phpDocModelFactory;
    /** @var PropertyModelFactoryInterface */
    private $propertyModelFactory;
    /** @var ConstantModelFactoryInterface */
    private $constantModelFactory;
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
    /** @var FinalClassModelFactoryInterface */
    private $finalClassModelFactory;
    /** @var TraitClassModelFactoryInterface */
    private $traitClassModelFactory;
    /** @var ClassModelFactoryInterface */
    private $classModelFactory;
    /** @var AbstractClassModelFactoryInterface */
    private $abstractClassModelFactory;
    /** @var InterfaceClassModelFactoryInterface */
    private $interfaceClassModelFactory;
    /** @var MethodModelFactoryInterface */
    private $methodModelFactory;
    /** @var GetterSetterModelFactoryInterface */
    private $getterSetterModelFactory;
    /** @var MethodParameterModelFactoryInterface */
    private $methodParameterModelFactory;
    /** @var ConstructorModelFactoryInterface */
    private $constructorModelFactory;
    /** @var ArrayGetterSetterModelFactoryInterface */
    private $arrayGetterSetterModelFactory;
    /** @var IsserSetterModelFactoryInterface */
    private $isserSetterModelFactory;
    /** @var AutoGetterSetterModelFactoryInterface */
    private $autoGetterSetterModelFactory;

    /** @var string */
    private $phpDocModelFactoryClass = PhpDocModelFactory::class;
    /** @var string */
    private $propertyModelFactoryClass = PropertyModelFactory::class;
    /** @var string */
    private $constantModelFactoryClass = ConstantModelFactory::class;
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
    private $finalClassModelFactoryClass = FinalClassModelFactory::class;
    /** @var string */
    private $traitClassModelFactoryClass = TraitClassModelFactory::class;
    /** @var string */
    private $classModelFactoryClass = ClassModelFactory::class;
    /** @var string */
    private $abstractClassModelFactoryClass = AbstractClassModelFactory::class;
    /** @var string */
    private $interfaceClassModelFactoryClass = InterfaceClassModelFactory::class;
    /** @var string */
    private $methodModelFactoryClass = MethodModelFactory::class;
    /** @var string */
    private $getterSetterModelFactoryClass = GetterSetterModelFactory::class;
    /** @var string */
    private $methodParameterModelFactoryClass = MethodParameterModelFactory::class;
    /** @var string */
    private $constructorModelFactoryClass = ConstructorModelFactory::class;
    /** @var string */
    private $arrayGetterSetterModelFactoryClass = ArrayGetterSetterModelFactory::class;
    /** @var string */
    private $isserSetterModelFactoryClass = IsserSetterModelFactory::class;
    /** @var string */
    private $autoGetterSetterModelFactoryClass = AutoGetterSetterModelFactory::class;

    /** @var string */
    private $phpDocClass = PhpDoc::class;
    /** @var string */
    private $propertyClass = Property::class;
    /** @var string */
    private $constantClass = Constant::class;
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
    /** @var string */
    private $finalClassClass = FinalClass::class;
    /** @var string */
    private $traitClassClass = TraitClass::class;
    /** @var string */
    private $classModelClass = Class_::class;
    /** @var string */
    private $abstractClassClass = AbstractClass::class;
    /** @var string */
    private $interfaceClassClass = InterfaceClass::class;
    /** @var string */
    private $methodClass = Method::class;
    /** @var string */
    private $getterSetterClass = GetterSetter::class;
    /** @var string */
    private $methodParameterClass = MethodParameter::class;
    /** @var string */
    private $constructorClass = Constructor::class;
    /** @var string */
    private $arrayGetterSetterClass = ArrayGetterSetter::class;
    /** @var string */
    private $isserSetterClass = IsserSetter::class;
    /** @var string */
    private $autoGetterSetterClass = AutoGetterSetter::class;

    public function buildPhpDocModelFactory(): PhpDocModelFactoryInterface
    {
        if (null === $this->phpDocModelFactory) {
            $this->phpDocModelFactory = new $this->phpDocModelFactoryClass(
                $this->phpDocClass
            );
        }

        return $this->phpDocModelFactory;
    }

    public function buildPropertyModelFactory(): PropertyModelFactoryInterface
    {
        if (null === $this->propertyModelFactory) {
            $this->propertyModelFactory = new $this->propertyModelFactoryClass(
                $this->propertyClass,
                $this->buildPhpDocModelFactory()
            );
        }

        return $this->propertyModelFactory;
    }

    public function buildConstantModelFactory(): ConstantModelFactoryInterface
    {
        if (null === $this->constantModelFactory) {
            $this->constantModelFactory = new $this->constantModelFactoryClass(
                $this->constantClass,
                $this->buildPropertyModelFactory()
            );
        }

        return $this->constantModelFactory;
    }

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

    public function buildFinalClassModelFactory(): FinalClassModelFactoryInterface
    {
        if (null === $this->finalClassModelFactory) {
            $this->finalClassModelFactory = new $this->finalClassModelFactoryClass(
                $this->finalClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->finalClassModelFactory;
    }

    public function buildTraitClassModelFactory(): TraitClassModelFactoryInterface
    {
        if (null === $this->traitClassModelFactory) {
            $this->traitClassModelFactory = new $this->traitClassModelFactoryClass(
                $this->traitClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->traitClassModelFactory;
    }

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

    public function buildAbstractClassModelFactory(): AbstractClassModelFactoryInterface
    {
        if (null === $this->abstractClassModelFactory) {
            $this->abstractClassModelFactory = new $this->abstractClassModelFactoryClass(
                $this->abstractClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->abstractClassModelFactory;
    }

    public function buildInterfaceClassModelFactory(): InterfaceClassModelFactoryInterface
    {
        if (null === $this->interfaceClassModelFactory) {
            $this->interfaceClassModelFactory = new $this->interfaceClassModelFactoryClass(
                $this->interfaceClassClass,
                $this->buildClassModelFactory()
            );
        }

        return $this->interfaceClassModelFactory;
    }

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

    public function getPhpDocModelFactoryClass(): string
    {
        return $this->phpDocModelFactoryClass;
    }

    public function setPhpDocModelFactoryClass(string $phpDocModelFactoryClass): void
    {
        $this->phpDocModelFactoryClass = $phpDocModelFactoryClass;
    }

    public function getPropertyModelFactoryClass(): string
    {
        return $this->propertyModelFactoryClass;
    }

    public function setPropertyModelFactoryClass(string $propertyModelFactoryClass): void
    {
        $this->propertyModelFactoryClass = $propertyModelFactoryClass;
    }

    public function getConstantModelFactoryClass(): string
    {
        return $this->constantModelFactoryClass;
    }

    public function setConstantModelFactoryClass(string $constantModelFactoryClass): void
    {
        $this->constantModelFactoryClass = $constantModelFactoryClass;
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

    public function getFinalClassModelFactoryClass(): string
    {
        return $this->finalClassModelFactoryClass;
    }

    public function setFinalClassModelFactoryClass(string $finalClassModelFactoryClass): void
    {
        $this->finalClassModelFactoryClass = $finalClassModelFactoryClass;
    }

    public function getTraitClassModelFactoryClass(): string
    {
        return $this->traitClassModelFactoryClass;
    }

    public function setTraitClassModelFactoryClass(string $traitClassModelFactoryClass): void
    {
        $this->traitClassModelFactoryClass = $traitClassModelFactoryClass;
    }

    public function getClassModelFactoryClass(): string
    {
        return $this->classModelFactoryClass;
    }

    public function setClassModelFactoryClass(string $classModelFactoryClass): void
    {
        $this->classModelFactoryClass = $classModelFactoryClass;
    }

    public function getAbstractClassModelFactoryClass(): string
    {
        return $this->abstractClassModelFactoryClass;
    }

    public function setAbstractClassModelFactoryClass(string $abstractClassModelFactoryClass): void
    {
        $this->abstractClassModelFactoryClass = $abstractClassModelFactoryClass;
    }

    public function getInterfaceClassModelFactoryClass(): string
    {
        return $this->interfaceClassModelFactoryClass;
    }

    public function setInterfaceClassModelFactoryClass(string $interfaceClassModelFactoryClass): void
    {
        $this->interfaceClassModelFactoryClass = $interfaceClassModelFactoryClass;
    }

    public function getMethodModelFactoryClass(): string
    {
        return $this->methodModelFactoryClass;
    }

    public function setMethodModelFactoryClass(string $methodModelFactoryClass): void
    {
        $this->methodModelFactoryClass = $methodModelFactoryClass;
    }

    public function getGetterSetterModelFactoryClass(): string
    {
        return $this->getterSetterModelFactoryClass;
    }

    public function setGetterSetterModelFactoryClass(string $getterSetterModelFactoryClass): void
    {
        $this->getterSetterModelFactoryClass = $getterSetterModelFactoryClass;
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

    public function getPhpDocClass(): string
    {
        return $this->phpDocClass;
    }

    public function setPhpDocClass(string $phpDocClass): void
    {
        $this->phpDocClass = $phpDocClass;
    }

    public function getPropertyClass(): string
    {
        return $this->propertyClass;
    }

    public function setPropertyClass(string $propertyClass): void
    {
        $this->propertyClass = $propertyClass;
    }

    public function getConstantClass(): string
    {
        return $this->constantClass;
    }

    public function setConstantClass(string $constantClass): void
    {
        $this->constantClass = $constantClass;
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

    public function getFinalClassClass(): string
    {
        return $this->finalClassClass;
    }

    public function setFinalClassClass(string $finalClassClass): void
    {
        $this->finalClassClass = $finalClassClass;
    }

    public function getTraitClassClass(): string
    {
        return $this->traitClassClass;
    }

    public function setTraitClassClass(string $traitClassClass): void
    {
        $this->traitClassClass = $traitClassClass;
    }

    public function getClassModelClass(): string
    {
        return $this->classModelClass;
    }

    public function setClassModelClass(string $classModelClass): void
    {
        $this->classModelClass = $classModelClass;
    }

    public function getAbstractClassClass(): string
    {
        return $this->abstractClassClass;
    }

    public function setAbstractClassClass(string $abstractClassClass): void
    {
        $this->abstractClassClass = $abstractClassClass;
    }

    public function getInterfaceClassClass(): string
    {
        return $this->interfaceClassClass;
    }

    public function setInterfaceClassClass(string $interfaceClassClass): void
    {
        $this->interfaceClassClass = $interfaceClassClass;
    }

    public function getMethodClass(): string
    {
        return $this->methodClass;
    }

    public function setMethodClass(string $methodClass): void
    {
        $this->methodClass = $methodClass;
    }

    public function getGetterSetterClass(): string
    {
        return $this->getterSetterClass;
    }

    public function setGetterSetterClass(string $getterSetterClass): void
    {
        $this->getterSetterClass = $getterSetterClass;
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
