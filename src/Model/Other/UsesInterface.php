<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface UsesInterface extends ModelInterface
{
    /**
     * @param string $namespace The current namespace
     * @param string|null $className
     * @param UseModelInterface[] $uses
     */
    public function configure(
        string $namespace,
        ?string $className = null,
        array $uses = []
    ): void;

    public function isUsable(string $str): bool;

    public function addRawUseOrReturnType(string $use): string;

    public function addRawUse(string $use, ?string $desiredAlias = null): void;

    public function hasInternalUse(string $internalName): bool;

    public function getInternalName(string $use): ?string;

    public function cleanUse(string $use): string;

    public function addUse(UseModelInterface $useModel): void;

    public function hasUse(string $use): bool;

    public function getUse(string $use): ?UseModelInterface;

    /**
     * @return UseModelInterface[]
     */
    public function getUseModels(): array;

    /**
     * @param UseModelInterface[] $uses
     */
    public function setUseModels(array $uses): void;
}
