<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\View\Other\UseViewInterface;

final class UseViewFactory implements UseViewFactoryInterface
{
    /** @var string */
    protected $useViewClass;

    public function __construct(string $useViewClass)
    {
        $this->useViewClass = $useViewClass;
    }

    public function create(UseInterface $useModel): UseViewInterface
    {
        return new $this->useViewClass($useModel);
    }
}
