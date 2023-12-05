<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

use Prometee\PhpClassGenerator\Model\ModelInterface;

interface AttributeInterface extends ModelInterface
{
    public function configure(array $lines = []): void;

    public function orderLines(callable $orderingCallable): void;

    public function addLine(string $line): void;

    /**
     * @return string[]
     */
    public function getLines(): array;

    /**
     * @param string[] $lines
     */
    public function setLines(array $lines): void;

    public function hasSingleLine(): bool;
}
