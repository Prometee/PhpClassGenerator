<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface TraitsInterface extends ModelInterface, UsesAwareInterface
{
    /**
     * @param array<int, string> $traits
     */
    public function configure(array $traits = []): void;

    public function setTrait(string $class, ?string $desiredAlias = null): void;

    public function addTrait(string $name, ?string $desiredAlias = null): void;

    public function hasTrait(string $class): bool;

    /**
     * @return array<int, string>
     */
    public function getTraits(): array;

    /**
     * @param array<int, string> $traits
     */
    public function setTraits(array $traits): void;
}
