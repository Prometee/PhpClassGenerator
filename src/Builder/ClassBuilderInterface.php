<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder;

use Prometee\PhpClassGenerator\Builder\Model\ModelFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Builder\View\ViewFactoryBuilderInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;

interface ClassBuilderInterface
{
    public const CLASS_TYPE_CLASS = 'class';
    public const CLASS_TYPE_FINAL = 'final';
    public const CLASS_TYPE_ABSTRACT = 'abstract';
    public const CLASS_TYPE_INTERFACE = 'interface';
    public const CLASS_TYPE_TRAIT = 'trait';

    public function build(
        string $namespace,
        string $className
    ): ?string;

    public function buildClass(string $namespace, string $className): ClassInterface;

    public function renderClass(ClassInterface $classModel): ?string;

    public function buildGetterSetter(PropertyInterface $property): GetterSetterInterface;

    public function reset(): void;

    public function getIndent(): string;

    public function getClassType(): string;

    public function setClassType(string $classType): void;

    public function getViewFactoryBuilder(): ViewFactoryBuilderInterface;

    public function setExtendClass(?string $extendClass): void;

    /**
     * @return PropertyInterface[]
     */
    public function getProperties(): array;

    /** @param non-empty-string $eol */
    public function setEol(string $eol): void;

    public function addClassicProperty(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void;

    public function addProperty(PropertyInterface $property): void;

    public function createProperty(
        string $name,
        array $types,
        ?string $value,
        string $description = ''
    ): PropertyInterface;

    public function addClassicConstant(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void;

    public function createConstant(
        string $name,
        array $types,
        ?string $value,
        string $description = ''
    ): ConstantInterface;

    public function getEol(): string;

    public function getExtendClass(): ?string;

    /**
     * @param string[] $implements
     */
    public function setImplements(array $implements): void;

    public function setIndent(string $indent): void;

    public function getModelFactoryBuilder(): ModelFactoryBuilderInterface;

    /**
     * @return string[]
     */
    public function getImplements(): array;

    public function createMethod(
        string $scope,
        string $name,
        array $returnTypes = [],
        bool $static = false,
        string $description = ''
    ): MethodInterface;

    public function addMethod(MethodInterface $method): void;

    public function getUses(): UsesInterface;

    public function setUses(UsesInterface $uses): void;
}
