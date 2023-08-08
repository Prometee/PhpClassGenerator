<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View;

interface ViewInterface
{
    /**
     * @param string|null $indent Global indentation
     * @param non-empty-string|null $eol End of line
     *
     * @return string|null
     */
    public function render(string $indent = null, string $eol = null): ?string;

    /** @param non-empty-string $eol */
    public function setEol(string $eol): void;

    public function setIndent(string $indent): void;

    public function getEol(): string;

    public function getIndent(): string;
}
