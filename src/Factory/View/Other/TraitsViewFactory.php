<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\View\Other\TraitsViewInterface;

final class TraitsViewFactory implements TraitsViewFactoryInterface
{
    /** @var string */
    protected $traitsViewClass;

    public function __construct(string $traitsViewClass)
    {
        $this->traitsViewClass = $traitsViewClass;
    }

    public function create(TraitsInterface $traits): TraitsViewInterface
    {
        return new $this->traitsViewClass($traits);
    }
}
