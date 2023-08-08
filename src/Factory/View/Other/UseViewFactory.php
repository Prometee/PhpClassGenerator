<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\View\Other\UseViewInterface;

final class UseViewFactory implements UseViewFactoryInterface
{
    public function __construct(
        /** @var class-string<UseViewInterface> */
        protected string $useViewClass,
    ) {
    }

    public function create(UseInterface $useModel): UseViewInterface
    {
        return new $this->useViewClass($useModel);
    }
}
