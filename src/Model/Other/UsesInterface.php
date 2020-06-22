<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface UsesInterface extends ModelInterface
{
    /**
     * @param string $namespace The current namespace
     * @param string|null $className
     * @param array<string, string> $uses
     * @param array<string, string> $internalUses
     */
    public function configure(
        string $namespace,
        ?string $className = null,
        array $uses = [],
        array $internalUses = []
    ): void;

    public function isUsable(string $str): bool;

    public function guessUseOrReturnType(string $use): string;

    public function guessUse(string $use, string $alias = ''): void;

    public function hasInternalUse(string $internalUseName): bool;

    public function getInternalUse(string $internalUseName): ?string;

    public function getInternalUseName(string $use): ?string;

    public function processInternalUseName(string $use, string $internalUseName = ''): void;

    public function cleanUse(string $use): string;

    public function getUseAlias(string $use): ?string;

    public function setUse(string $use, string $alias = ''): void;

    public function addUse(string $use, string $alias = ''): void;

    public function hasUse(string $use): bool;

    /**
     * @return array<string, string>
     */
    public function getUses(): array;

    /**
     * @param array<string, string> $uses
     */
    public function setUses(array $uses): void;
}
