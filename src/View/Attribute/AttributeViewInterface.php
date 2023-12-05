<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Attribute;

use Prometee\PhpClassGenerator\View\ViewInterface;

interface AttributeViewInterface extends ViewInterface
{
    /**
     * @return array<int, string>
     */
    public function buildLines(): array;

    /**
     * Order doc lines
     */
    public function orderLines(): void;

    public function getLineStartIndent(): string;

    public function setLineStartIndent(string $lineStartIndent): void;
}
