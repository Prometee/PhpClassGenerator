<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use LogicException;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;

class TraitsView extends AbstractArrayView implements TraitsViewInterface
{
    public function __construct(protected TraitsInterface $traits)
    {
    }

    public function getArrayToBuild(): array
    {
        return $this->traits->getTraits();
    }

    public function buildArrayItemString($key, string $item): string
    {
        $item = $this->traits->getUses()->getInternalName($item);
        if (null === $item) {
            throw new LogicException('The $item could not be null !');
        }

        $prefix = '%2$s%2$s';
        $suffix = ',%1$s';
        if ($key === array_key_first($this->getArrayToBuild())) {
            $prefix = '%2$suse ';
        }
        if ($key === array_key_last($this->getArrayToBuild())) {
            $suffix = ';%1$s%1$s';
        }
        $format = sprintf('%s%s%s', $prefix, '%3$s', $suffix);
        return sprintf($format, $this->eol, $this->indent, $item);
    }
}
