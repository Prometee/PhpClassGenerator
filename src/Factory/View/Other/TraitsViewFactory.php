<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\View\Other\TraitsViewInterface;

final class TraitsViewFactory implements TraitsViewFactoryInterface
{
    public function __construct(
        /** @var class-string<TraitsViewInterface> */
        protected string $traitsViewClass,
    ) {
    }

    public function create(TraitsInterface $traits): TraitsViewInterface
    {
        return new $this->traitsViewClass($traits);
    }
}
