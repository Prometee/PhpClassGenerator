<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Builder\Model\ModelFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Builder\View\ViewFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\Model\Method\ConstructorInterface;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodParameterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

class ClassBuilder implements ClassBuilderInterface
{
    protected string $indent = '    ';
    /** @var non-empty-string */
    protected string $eol = "\n";

    protected UsesInterface $uses;

    protected string $classType;
    /** @var PropertyInterface[] */
    protected array $properties = [];
    /** @var MethodInterface[] */
    protected array $methods = [];
    protected ?string $extendClass = null;
    /** @var string[] */
    protected array $implements = [];

    protected UsesModelFactoryInterface $usesModelFactory;
    protected MethodParameterModelFactoryInterface $methodParameterModelFactory;
    protected ConstructorModelFactoryInterface $constructorModelFactory;
    protected PropertyModelFactoryInterface $propertyModelFactory;
    protected ConstantModelFactoryInterface $constantModelFactory;
    protected AutoGetterSetterModelFactoryInterface $autoGetterSetterModelFactory;
    protected ClassViewFactoryInterface $classViewFactory;
    protected MethodModelFactoryInterface $methodModelFactory;

    public function __construct(
        protected ModelFactoryBuilderInterface $modelFactoryBuilder,
        protected ViewFactoryBuilderInterface $viewFactoryBuilder,
        string $classType = self::CLASS_TYPE_CLASS
    ) {
        $this->usesModelFactory = $this->modelFactoryBuilder->buildUsesModelFactory();
        $this->constructorModelFactory = $this->modelFactoryBuilder->buildConstructorModelFactory();
        $this->methodParameterModelFactory = $this->modelFactoryBuilder->buildMethodParameterModelFactory();
        $this->propertyModelFactory = $this->modelFactoryBuilder->buildPropertyModelFactory();
        $this->constantModelFactory = $this->modelFactoryBuilder->buildConstantModelFactory();
        $this->autoGetterSetterModelFactory = $this->modelFactoryBuilder->buildAutoGetterSetterModelFactory();
        $this->methodModelFactory = $this->modelFactoryBuilder->buildMethodModelFactory();
        $this->classViewFactory = $this->viewFactoryBuilder->buildClassViewFactory();

        $this->uses = $this->usesModelFactory->create();
        $this->setClassType($classType);
    }

    public function addClassicConstant(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void {
        $constant = $this->createConstant($name, $types, $value, $description);
        $this->addProperty($constant);
    }

    public function createConstant(
        string $name,
        array $types,
        ?string $value,
        string $description = ''
    ): ConstantInterface {
        $constant = $this->constantModelFactory->create($this->getUses());

        $constant->configure(
            $name,
            $types,
            $value,
            $description
        );

        return $constant;
    }

    public function addProperty(PropertyInterface $property): void
    {
        $this->properties[$property->getName()] = $property;
    }

    public function addClassicProperty(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void {
        $property = $this->createProperty($name, $types, $value, $description);
        $this->addProperty($property);
    }

    public function createProperty(
        string $name,
        array $types,
        ?string $value,
        string $description = ''
    ): PropertyInterface {
        $property = $this->propertyModelFactory->create($this->getUses());

        $property->configure(
            $name,
            $types,
            $value,
            $description
        );

        return $property;
    }

    public function createMethod(
        string $scope,
        string $name,
        array $returnTypes = [],
        bool $static = false,
        string $description = ''
    ): MethodInterface {
        $method = $this->methodModelFactory->create($this->getUses());
        $method->configure(
            $scope,
            $name,
            $returnTypes,
            $static,
            $description
        );
        return $method;
    }

    public function addMethod(MethodInterface $method): void
    {
        $this->methods[$method->getName()] = $method;
    }

    public function build(
        string $namespace,
        string $className
    ): ?string {
        $classModel = $this->buildClass($namespace, $className);

        $classContent = $this->renderClass($classModel);

        $this->reset();

        return $classContent;
    }

    public function buildClass(string $namespace, string $className): ClassInterface
    {
        $classModel = $this->buildClassModel($this->classType);
        $classModel->configure(
            $namespace,
            $className,
            $this->extendClass,
            $this->implements
        );

        $constructor = $this->buildConstructor();
        if (null !== $constructor) {
            $classModel->getMethods()->addMethod($constructor);
        }

        foreach ($this->properties as $property) {
            $classModel->getProperties()->addProperty($property);

            if ($property->isInherited()) {
                continue;
            }

            $getterSetter = $this->buildGetterSetter($property);
            $classModel
                ->getMethods()
                ->addMultipleMethod($getterSetter->getMethods());
        }

        foreach ($this->methods as $method) {
            $method->setUses($classModel->getUses());
            $classModel->getMethods()->addMethod($method);
        }

        return $classModel;
    }

    public function renderClass(ClassInterface $classModel): ?string
    {
        return $this->classViewFactory->create($classModel)->render($this->indent, $this->eol);
    }

    protected function buildConstructor(): ?ConstructorInterface
    {
        $constructor = $this->constructorModelFactory->create($this->getUses());
        $inheritedParameters = [];
        foreach ($this->properties as $property) {
            $methodParameter = $this->buildParameterFromProperty($constructor->getUses(), $property);
            if (null === $methodParameter) {
                continue;
            }

            $constructor->addParameter($methodParameter);

            if ($property->isInheritedAndInheritedRequired()) {
                $inheritedParameters[$property->getPhpName()] = $property->getInheritedPosition();
                continue;
            }

            if ($property->isPromoted()) {
                continue;
            }

            $constructor->addLine(sprintf(
                '$this->%s = %s;',
                $property->getName(),
                $methodParameter->getPhpName()
            ));
        }

        if (false === empty($inheritedParameters)) {
            uasort($inheritedParameters, static function ($pos1, $pos2) {
                if ($pos1 === $pos2) {
                    return 0;
                }

                if (null === $pos1) {
                    return 1;
                }

                return ($pos1 < $pos2) ? -1 : 1;
            });

            $separator = ' ';
            $beforeParameters = '';
            $afterParameters = '';
            if (count($inheritedParameters) > 3) {
                $separator = $this->eol . $this->indent;
                $beforeParameters = $separator;
                $afterParameters = $this->eol;
            }

            $constructor->addLine(sprintf(
                'parent::%s(%s%s%s);',
                $constructor->getName(),
                $beforeParameters,
                implode(',' . $separator, array_keys($inheritedParameters)),
                $afterParameters
            ));
        }

        if (0 === count($constructor->getParameters()) && 0 === count($constructor->getLines())) {
            return null;
        }

        return $constructor;
    }

    protected function buildParameterFromProperty(UsesInterface $uses, PropertyInterface $property): ?MethodParameterInterface
    {
        $isInheritedAndInheritedRequired = $property->isInheritedAndInheritedRequired();

        if (!$isInheritedAndInheritedRequired && in_array('null', $property->getTypes())) {
            return null;
        }

        if (!$isInheritedAndInheritedRequired && null !== $property->getValue()) {
            return null;
        }

        $methodParameter = $this->methodParameterModelFactory->create($uses);
        $methodParameter->configure(
            $property->getTypes(),
            $property->getName()
        );
        $methodParameter->setDescription($property->getDescription());
        $methodParameter->setValue($property->getValue());

        if ($property->isPromoted()) {
            $methodParameter->setScope($property->getScope());
            $methodParameter->setPhpDoc($property->getPhpDoc());
            $methodParameter->setAttribute($property->getAttribute());
        }

        return $methodParameter;
    }

    public function buildGetterSetter(PropertyInterface $property): GetterSetterInterface
    {
        $autoGetterSetter = $this->autoGetterSetterModelFactory->create($property->getUses());
        return $autoGetterSetter->configure($property);
    }

    public function reset(): void
    {
        $this->setClassType(self::CLASS_TYPE_CLASS);
        $this->uses = $this->usesModelFactory->create();
        $this->properties = [];
    }

    public function buildClassModel(string $classType): ClassInterface
    {
        switch ($classType) {
            case self::CLASS_TYPE_FINAL:
                $classModelFactory = $this->modelFactoryBuilder->buildFinalClassModelFactory();
                return $classModelFactory->create($this->getUses());
            case self::CLASS_TYPE_ABSTRACT:
                $classModelFactory = $this->modelFactoryBuilder->buildAbstractClassModelFactory();
                return $classModelFactory->create($this->getUses());
            case self::CLASS_TYPE_INTERFACE:
                $classModelFactory = $this->modelFactoryBuilder->buildInterfaceClassModelFactory();
                return $classModelFactory->create($this->getUses());
            case self::CLASS_TYPE_TRAIT:
                $classModelFactory = $this->modelFactoryBuilder->buildTraitClassModelFactory();
                return $classModelFactory->create($this->getUses());
            default:
                $classModelFactory = $this->modelFactoryBuilder->buildClassModelFactory();
                return $classModelFactory->create($this->getUses());
        }
    }

    public function setClassType(string $classType): void
    {
        $this->classType = strtolower($classType);
    }

    public function getClassType(): string
    {
        return $this->classType;
    }

    public function getExtendClass(): ?string
    {
        return $this->extendClass;
    }

    public function setExtendClass(?string $extendClass): void
    {
        $this->extendClass = $extendClass;
    }

    public function getImplements(): array
    {
        return $this->implements;
    }

    public function setImplements(array $implements): void
    {
        $this->implements = $implements;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getModelFactoryBuilder(): ModelFactoryBuilderInterface
    {
        return $this->modelFactoryBuilder;
    }

    public function getViewFactoryBuilder(): ViewFactoryBuilderInterface
    {
        return $this->viewFactoryBuilder;
    }

    public function getIndent(): string
    {
        return $this->indent;
    }

    public function setIndent(string $indent): void
    {
        $this->indent = $indent;
    }

    public function getEol(): string
    {
        return $this->eol;
    }

    public function setEol(string $eol): void
    {
        $this->eol = $eol;
    }

    public function getUses(): UsesInterface
    {
        return $this->uses;
    }

    public function setUses(UsesInterface $uses): void
    {
        $this->uses = $uses;
    }
}
