<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

class UsesView extends AbstractArrayView implements UsesViewInterface
{
    /** @var UsesInterface */
    protected $uses;

    public function __construct(UsesInterface $uses)
    {
        $this->uses = $uses;
    }

    public function getArrayToBuild(): array
    {
        return $this->uses->getUses();
    }

    /**
     * {@inheritDoc}
     */
    public function render(string $indent = null, string $eol = null): ?string
    {
        $content = parent::render($indent, $eol);

        if (empty($content)) {
            return $content;
        }

        return $content . $this->eol;
    }

    public function buildArrayItemString($key, string $item): string
    {
        $alias = '';
        if (!empty($item)) {
            $alias = sprintf(' as %s', $item);
        }

        return sprintf(
            'use %s%s;%s',
            $key,
            $alias,
            $this->eol
        );
    }
}
