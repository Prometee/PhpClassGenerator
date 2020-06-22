<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Factory\Model\Attribute\PropertyModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Method\AutoGetterSetterModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\ClassView\ClassViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\ClassModel\ClassModelInterface;

final class ClassBuilder implements ClassBuilderInterface
{
    /** @var string */
    private $classType;

    /** @var ClassModelInterface */
    private $classModel;
    /** @var PropertyInterface[] */
    private $properties = [];

    /** @var ModelFactoryBuilderInterface */
    private $modelFactoryBuilder;
    /** @var ViewFactoryBuilderInterface */
    private $viewFactoryBuilder;
    /** @var string|null */
    private $extendClass;
    /** @var string[] */
    private $implements = [];
    /** @var PropertyModelFactoryInterface */
    private $propertyModelFactory;
    /** @var AutoGetterSetterModelFactoryInterface */
    private $autoGetterSetterModelFactory;
    /** @var ClassViewFactoryInterface */
    private $classViewFactory;

    /** @var string */
    private $indent = '    ';
    /** @var string */
    private $eol = "\n";

    public function __construct(
        ModelFactoryBuilderInterface $modelFactoryBuilder,
        ViewFactoryBuilderInterface $viewFactoryBuilder,
        string $classType = self::CLASS_TYPE_CLASS
    ) {
        $this->modelFactoryBuilder = $modelFactoryBuilder;
        $this->viewFactoryBuilder = $viewFactoryBuilder;
        $this->setClassType($classType);

        $this->propertyModelFactory = $this->modelFactoryBuilder->buildPropertyModelFactory();
        $this->autoGetterSetterModelFactory = $this->modelFactoryBuilder->buildAutoGetterSetterModelFactory();

        $this->classViewFactory = $this->viewFactoryBuilder->buildClassViewFactory();
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

    public function createProperty(string $name, array $types, ?string $value, string $description): PropertyInterface
    {
        $property = $this->propertyModelFactory->create($this->classModel->getUses());

        $property->configure(
            $name,
            $types,
            $value,
            $description
        );

        return $property;
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

        foreach ($this->properties as $property) {
            $this->classModel->getProperties()->addProperty($property);
            $autoGetterSetter = $this->autoGetterSetterModelFactory->create($this->classModel->getUses());
            $getterSetter = $autoGetterSetter->configure($property);
            $this->classModel
                ->getMethods()
                ->addMultipleMethod($getterSetter->getMethods($this->getIndent()));
        }

        $classView = $this->classViewFactory->create($this->classModel);
        $classContent = $classView->render($this->indent, $this->eol);

        $this->reset();

        return $classContent;
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

    public function setClassType(string $classType): void
    {
        $this->classType = ucfirst($classType);
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

    public function getClassModel(): ClassModelInterface
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
