<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

use Prometee\PhpClassGenerator\Model\AbstractModel;

class Attribute extends AbstractModel implements AttributeInterface
{
    /** @var string[] */
    protected array $lines = [];

    public function configure(array $lines = []): void
    {
        $this->lines = $lines;
    }

    public function orderLines(callable $orderingCallable): void
    {
        uasort($this->lines, $orderingCallable);
    }

    public function addLine(string $line): void
    {
        $this->lines[] = $line;
    }

    public function hasSingleLine(): bool
    {
        return count($this->lines) === 1;
    }

    public function getLines(): array
    {
        return $this->lines;
    }

    public function setLines(array $lines): void
    {
        $this->lines = $lines;
    }
}
