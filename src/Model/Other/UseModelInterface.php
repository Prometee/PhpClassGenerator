<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Other;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface UseModelInterface extends ModelInterface
{
    public function configure(string $use, ?string $desiredAlias = null): void;
    public function configureAlias(string $desiredAlias): void;

    public function setAlias(?string $alias): void;
    public function getAlias(): ?string;

    public function getUse(): string;
    public function setUse(string $use): void;

    public function setClassName(string $className): void;
    public function getClassName(): string;

    public function getInternalName(): string;
    public function setInternalName(string $internalName): void;

    public function getNamespace(): string;
    public function setNamespace(string $namespace): void;

    public function markAsMuted(): void;
    public function isMuted(): bool;
    public function setMuted(bool $muted): void;
}
