<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\View\Other\UsesViewInterface;

final class UsesViewFactory implements UsesViewFactoryInterface
{
    public function __construct(
        /** @var class-string<UsesViewInterface> */
        protected string $usesViewClass,
        protected UseViewFactoryInterface $useViewFactory,
    ) {
    }

    public function create(UsesInterface $uses): UsesViewInterface
    {
        return new $this->usesViewClass(
            $uses,
            $this->useViewFactory
        );
    }
}
