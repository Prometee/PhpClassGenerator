<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeAwareInterface;
use Prometee\PhpClassGenerator\Model\ModelInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareInterface;

interface MethodParameterInterface extends ModelInterface, UsesAwareInterface, PhpDocAwareInterface, AttributeAwareInterface
{
    /**
     * @param string[] $types
     * @param string $name
     * @param string|null $value
     * @param bool $byReference
     * @param string $description
     */
    public function configure(
        array $types,
        string $name,
        ?string $value = null,
        bool $byReference = false,
        string $description = ''
    ): void;

    public function getScope(): string;

    public function hasScope(): bool;

    public function setScope(string $scope): void;

    public function getDescription(): string;

    public function isByReference(): bool;

    public function getTypes(): array;

    public function setTypes(array $types): void;

    public function addType(string $type): void;

    public function hasType(string $type): bool;

    public function getName(): string;

    public function setByReference(bool $byReference): void;

    public function getPhpDocType(): string;

    public function setValue(?string $value): void;

    public function getPhpName(): string;

    public function setName(string $name): void;

    public function setDescription(string $description): void;

    public function getPhpTypeFromTypes(): string;

    public function getValue(): ?string;
}
