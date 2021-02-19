<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator;

interface PhpGeneratorInterface
{
    public function configure(
        string $path,
        string $namespace,
        array $classesConfig = []
    ): void;

    /**
     * @param string|null $indent indentation (default will be: '    ')
     * @param string|null $eol end of line (default will be: "\n")
     *
     * @return bool
     */
    public function generate(
        ?string $indent = null,
        ?string $eol = null
    ): bool;

    public function writeClass(string $classContent, string $classFilePath): bool;
}
