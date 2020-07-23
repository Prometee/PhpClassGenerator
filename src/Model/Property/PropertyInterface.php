<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Property;

use Prometee\PhpClassGenerator\Model\ModelInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;
use Prometee\PhpClassGenerator\Model\PhpDoc\PhpDocAwareInterface;

interface PropertyInterface extends ModelInterface, PhpDocAwareInterface, UsesAwareInterface
{
    public function configure(
        string $name,
        array $types = [],
        ?string $value = null,
        string $description = ''
    ): void;

    public function getScope(): string;

    public function setScope(string $scope): void;

    public function getValue(): ?string;

    public function setName(string $name): void;

    public function setValue(?string $value): void;

    public function getName(): string;

    public function getPhpName(): string;

    public function getPhpTypeFromTypes(): string;

    public function getDefaultValueFromTypes(): ?string;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    /**
     * @return string[]
     */
    public function getTypes(): array;

    /**
     * @param string[] $types
     */
    public function setTypes(array $types): void;

    public function addType(string $type): void;

    public function hasType(string $type): bool;

    public function getPhpDocType(): ?string;

    public function setReadable(bool $readOnly): void;

    public function isReadable(): bool;

    public function setWriteable(bool $writeOnly): void;

    public function isWriteable(): bool;

    public function isRequired(): bool;

    public function setRequired(bool $required): void;

    public function isInherited(): bool;

    public function setInherited(bool $inherited): void;

    public function isInheritedRequired(): bool;

    public function setInheritedRequired(bool $inherited_required): void;

    public function isInheritedAndInheritedRequired(): bool;
}
