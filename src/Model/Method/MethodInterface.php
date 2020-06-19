<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\ModelInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareInterface;

interface MethodInterface extends ModelInterface, PhpDocAwareInterface, UsesAwareInterface
{
    public const SCOPE_PUBLIC = 'public';
    public const SCOPE_PROTECTED = 'protected';
    public const SCOPE_PRIVATE = 'private';

    /**
     * @param string $scope
     * @param string $name
     * @param string[] $returnTypes
     * @param bool $static
     * @param string $description
     */
    public function configure(
        string $scope,
        string $name,
        array $returnTypes = [],
        bool $static = false,
        string $description = ''
    ): void;

    public function getDescription(): string;

    public function getPhpDocReturnType(): string;

    public function getReturnTypes(): array;

    public function getPhpTypeFromReturnTypes(): string;

    public function isStatic(): bool;

    /**
     * @param MethodParameterInterface[] $parameters
     */
    public function setParameters(array $parameters): void;

    public function addLine(string $line): void;

    public function hasParameter(MethodParameterInterface $methodParameter): bool;

    public function setStatic(bool $static): void;

    /**
     * @return MethodParameterInterface[]
     */
    public function getParameters(): array;

    public function setScope(string $scope): void;

    public function setLines(array $lines): void;

    public function setName(string $name): void;

    /**
     * @param string[] $returnTypes
     */
    public function setReturnTypes(array $returnTypes): void;

    public function addReturnType(string $returnType): void;

    public function hasReturnType(string $returnType): bool;

    public function setParameter(MethodParameterInterface $methodParameter): void;

    public function addParameter(MethodParameterInterface $methodParameter): void;

    public function setDescription(string $description): void;

    public function getName(): string;

    public function getScope(): string;

    public function getLines(): array;
}
