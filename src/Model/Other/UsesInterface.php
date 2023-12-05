<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface UsesInterface extends ModelInterface
{
    /**
     * @param string $namespace The current namespace
     * @param string|null $className
     * @param UseInterface[] $uses
     */
    public function configure(
        string $namespace,
        ?string $className = null,
        array $uses = []
    ): void;

    public function detectAndReplaceUsesInText(string $text, string $prefix = ''): string;

    public function isUsable(string $str): bool;

    public function addRawUseOrReturnType(string $use): string;

    public function addRawUse(string $use, ?string $desiredAlias = null): void;

    public function hasInternalUse(string $internalName): bool;

    public function getInternalName(string $use): ?string;

    public function cleanUse(string $use): string;

    public function addUse(UseInterface $useModel): void;

    public function hasUse(string $use): bool;

    public function getUse(string $use): ?UseInterface;

    /**
     * @return UseInterface[]
     */
    public function getUseModels(): array;

    /**
     * @param UseInterface[] $useModels
     */
    public function setUseModels(array $useModels): void;
}
