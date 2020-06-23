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
    protected function doRender(): ?string
    {
        $arrayToBuild = $this->getArrayToBuild();
        if (0 === count($arrayToBuild)) {
            return null;
        }

        $content = '';
        foreach ($arrayToBuild as $key => $item) {
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
