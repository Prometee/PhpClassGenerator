<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Builder\Model\ModelFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Builder\View\ViewFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\ConstructorModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\MethodParameterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\ConstantModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Property\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Class_\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\Model\Method\ConstructorInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

final class ClassBuilder implements ClassBuilderInterface
{
    /** @var string */
    private $classType;

    /** @var ClassInterface */
    private $classModel;
    /** @var PropertyInterface[] */
    private $properties = [];
    /** @var MethodInterface[] */
    private $methods = [];

    /** @var ModelFactoryBuilderInterface */
    private $modelFactoryBuilder;
    /** @var ViewFactoryBuilderInterface */
    private $viewFactoryBuilder;
    /** @var string|null */
    private $extendClass;
    /** @var string[] */
    private $implements = [];
    /** @var MethodParameterModelFactoryInterface */
    private $methodParameterModelFactory;
    /** @var ConstructorModelFactoryInterface */
    private $constructorModelFactory;
    /** @var PropertyModelFactoryInterface */
    private $propertyModelFactory;
    /** @var ConstantModelFactoryInterface */
    private $constantModelFactory;
    /** @var AutoGetterSetterModelFactoryInterface */
    private $autoGetterSetterModelFactory;
    /** @var ClassViewFactoryInterface */
    private $classViewFactory;

    /** @var string */
    private $indent = '    ';
    /** @var string */
    private $eol = "\n";
    /** @var MethodModelFactoryInterface */
    private $methodModelFactory;

    public function __construct(
        ModelFactoryBuilderInterface $modelFactoryBuilder,
        ViewFactoryBuilderInterface $viewFactoryBuilder,
        string $classType = self::CLASS_TYPE_CLASS
    ) {
        $this->modelFactoryBuilder = $modelFactoryBuilder;
        $this->viewFactoryBuilder = $viewFactoryBuilder;
        $this->setClassType($classType);

        $this->constructorModelFactory = $this->modelFactoryBuilder->buildConstructorModelFactory();
        $this->methodParameterModelFactory = $this->modelFactoryBuilder->buildMethodParameterModelFactory();
        $this->propertyModelFactory = $this->modelFactoryBuilder->buildPropertyModelFactory();
        $this->constantModelFactory = $this->modelFactoryBuilder->buildConstantModelFactory();
        $this->autoGetterSetterModelFactory = $this->modelFactoryBuilder->buildAutoGetterSetterModelFactory();
        $this->methodModelFactory = $this->modelFactoryBuilder->buildMethodModelFactory();

        $this->classViewFactory = $this->viewFactoryBuilder->buildClassViewFactory();
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
        string $description
    ): ConstantInterface {
        $constant = $this->constantModelFactory->create($this->classModel->getUses());

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
        string $description
    ): PropertyInterface {
        $property = $this->propertyModelFactory->create($this->classModel->getUses());

        $property->configure(
            $name,
            $types,
            $value,
            $description
        );

        return $property;
    }

    public function createMethod(): MethodInterface
    {
        return $this->methodModelFactory->create($this->classModel->getUses());
    }

    public function addMethod(MethodInterface $method): void
    {
        $this->methods[$method->getName()] = $method;
    }

    public function build(
        string $namespace,
        string $className
    ): ?string {
        $this->classModel->configure(
            $namespace,
            $className,
            $this->extendClass,
            $this->implements
        );

        $constructor = $this->buildConstructor();
        if (null !== $constructor) {
            $this->classModel->getMethods()->addMethod($constructor);
        }

        foreach ($this->properties as $property) {
            $this->classModel->getProperties()->addProperty($property);
            $autoGetterSetter = $this->autoGetterSetterModelFactory->create($this->classModel->getUses());
            $getterSetter = $autoGetterSetter->configure($property);

            if ($property->isInherited()) {
                continue;
            }

            $this->classModel
                ->getMethods()
                ->addMultipleMethod($getterSetter->getMethods($this->indent));
        }

        foreach ($this->methods as $method) {
            $method->setUses($this->classModel->getUses());
            $this->classModel->getMethods()->addMethod($method);
        }

        $classView = $this->classViewFactory->create($this->classModel);
        $classContent = $classView->render($this->indent, $this->eol);

        $this->reset();

        return $classContent;
    }

    private function buildConstructor(): ?ConstructorInterface
    {
        $constructor = $this->constructorModelFactory->create($this->classModel->getUses());
        $inheritedParameters = [];
        foreach ($this->properties as $property) {
            if (in_array('null', $property->getTypes())) {
                continue;
            }

            if (null !== $property->getValue()) {
                continue;
            }

            $methodParameter = $this->methodParameterModelFactory->create($constructor->getUses());
            $methodParameter->configure(
                $property->getTypes(),
                $property->getName()
            );
            $methodParameter->setDescription($property->getDescription());
            $constructor->addParameter($methodParameter);

            if ($property->isInherited()) {
                $inheritedParameters[] = $property->getPhpName();
                continue;
            }

            $constructor->addLine(sprintf(
                '$this->%s = %s;',
                $property->getName(),
                $methodParameter->getPhpName()
            ));
        }

        if (false === empty($inheritedParameters)) {
            $newLine = '';
            $afterParameters = '';
            if (count($inheritedParameters) > 3) {
                $newLine = $this->eol . $this->indent;
                $afterParameters = $this->eol;
            }

            $constructor->addLine(sprintf(
                'parent::%s(%s%s%s);',
                $constructor->getName(),
                $newLine,
                implode(', ' . $newLine, $inheritedParameters),
                $afterParameters
            ));
        }

        if (0 === count($constructor->getLines())) {
            return null;
        }

        return $constructor;
    }

    public function setClassType(string $classType): void
    {
        $this->classType = strtolower($classType);
        switch ($classType) {
            case self::CLASS_TYPE_FINAL:
                $classModelFactory = $this->modelFactoryBuilder->buildFinalClassModelFactory();
                break;
            case self::CLASS_TYPE_ABSTRACT:
                $classModelFactory = $this->modelFactoryBuilder->buildAbstractClassModelFactory();
                break;
            case self::CLASS_TYPE_INTERFACE:
                $classModelFactory = $this->modelFactoryBuilder->buildInterfaceClassModelFactory();
                break;
            case self::CLASS_TYPE_TRAIT:
                $classModelFactory = $this->modelFactoryBuilder->buildTraitClassModelFactory();
                break;
            default:
                $classModelFactory = $this->modelFactoryBuilder->buildClassModelFactory();
                break;
        }

        $this->classModel = $classModelFactory->create();
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

    /**
     * @return string[]
     */
    public function getImplements(): array
    {
        return $this->implements;
    }

    /**
     * @param string[] $implements
     */
    public function setImplements(array $implements): void
    {
        $this->implements = $implements;
    }

    public function getClassModel(): ClassInterface
    {
        return $this->classModel;
    }

    /**
     * @return PropertyInterface[]
     */
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

    private function reset(): void
    {
        $this->setClassType(self::CLASS_TYPE_CLASS);
        $this->properties = [];
    }
}
