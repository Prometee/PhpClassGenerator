<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\View\ViewInterface;

interface ArrayViewInterface extends ViewInterface
{
    /**
     * @return array<int|string, ViewInterface|string>
     */
    public function getArrayToBuild(): array;

    /**
     * @param string|int $key
     * @param string $item
     *
     * @return string
     */
    public function buildArrayItemString($key, string $item): string;

    /**
     * @param string|int $key
     * @param ViewInterface|string $item
     *
     * @return string|null
     */
    public function buildArrayItem($key, $item): ?string;
}
