<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View;

abstract class AbstractView implements ViewInterface
{
    protected string $indent = '    ';

    /** @var non-empty-string */
    protected string $eol = PHP_EOL;

    public function render(string $indent = null, string $eol = null): ?string
    {
        $this->indent = $indent ?? $this->indent;
        $this->eol = $eol ?? $this->eol;

        return $this->doRender();
    }

    abstract protected function doRender(): ?string;

    public function getEol(): string
    {
        return $this->eol;
    }

    public function setEol(string $eol): void
    {
        $this->eol = $eol;
    }

    public function getIndent(): string
    {
        return $this->indent;
    }

    public function setIndent(string $indent): void
    {
        $this->indent = $indent;
    }
}
