<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\View\AbstractView;
use Prometee\PhpClassGenerator\View\ViewInterface;

abstract class AbstractArrayView extends AbstractView implements ArrayViewInterface
{
    abstract public function getArrayToBuild(): array;

    /**
     * {@inheritDoc}
     */
    public function render(string $indent = null, string $eol = null): ?string
    {
        parent::render($indent, $eol);

        if (0 === count($this->getArrayToBuild())) {
            return null;
        }

        $content = '';
        foreach ($this->getArrayToBuild() as $key => $item) {
            $content .= $this->buildArrayItem($key, $item);
        }

        return $content;
    }

    public function buildArrayItem($key, $item): ?string
    {
        if ($item instanceof ViewInterface) {
            return $item->render($this->indent, $this->eol);
        }

        if (is_string($item)) {
            return $this->buildArrayItemString($key, $item);
        }
    }

    public function buildArrayItemString($key, string $item): string
    {
        return $item;
    }
}
