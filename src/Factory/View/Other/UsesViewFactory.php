<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\View\Other\UsesViewInterface;

final class UsesViewFactory implements UsesViewFactoryInterface
{
    /** @var string */
    protected $usesViewClass;
    /** @var UseViewFactoryInterface */
    protected $useViewFactory;

    public function __construct(
        string $usesViewClass,
        UseViewFactoryInterface $useViewFactory
    ) {
        $this->usesViewClass = $usesViewClass;
        $this->useViewFactory = $useViewFactory;
    }

    public function create(UsesInterface $uses): UsesViewInterface
    {
        return new $this->usesViewClass(
            $uses,
            $this->useViewFactory
        );
    }
}
