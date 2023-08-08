<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\PhpDoc;

use Prometee\PhpClassGenerator\View\ViewInterface;

interface PhpDocViewInterface extends ViewInterface
{
    public const DEFAULT_WRAP_ON = 110;

    /**
     * @return array<int, string>
     */
    public function buildLines(): array;

    /**
     * @param string $type
     * @param array<int, string> $lines
     *
     * @return array<int, string>
     */
    public function buildTypedLines(string $type, array $lines): array;

    public function buildTypedLinePrefix(string $type): string;

    /**
     * @param string $linePrefix
     * @param string $line
     *
     * @return array<int, string>
     */
    public function buildLinesFromSingleLine(string $linePrefix, string $line): array;

    /**
     * @param string $line
     * @param int|null $wrapOn
     *
     * @return array<int, string>
     */
    public function wrapLines(string $line, ?int $wrapOn = null): array;

    /**
     * Order doc lines
     */
    public function orderLines(): void;

    public function getWrapOn(): int;

    public function setWrapOn(int $wrapOn): void;

    public function getLineStartIndent(): string;

    public function setLineStartIndent(string $lineStartIndent): void;
}
