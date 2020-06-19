<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator;

interface PhpGeneratorInterface
{
    public function generate(
        ?string $indent = null,
        ?string $eol = null
    ): bool;

    public function writeClass(string $classContent, string $classFilePath): bool;
}
