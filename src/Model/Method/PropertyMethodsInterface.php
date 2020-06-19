<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesAwareInterface;

interface PropertyMethodsInterface extends UsesAwareInterface
{
    public function configure(
        PropertyInterface $property,
        bool $readOnly = false,
        bool $writeOnly = false
    ): void;

    public function isReadOnly(): bool;

    public function setReadOnly(bool $readOnly): void;

    /**
     * @param string|null $indent
     *
     * @return MethodInterface[]
     */
    public function getMethods(string $indent = null): array;

    public function setWriteOnly(bool $writeOnly): void;

    public function isWriteOnly(): bool;
}
