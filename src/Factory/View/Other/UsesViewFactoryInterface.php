<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UsesInterface;
use Prometee\PhpClassGenerator\View\Other\UsesViewInterface;

interface UsesViewFactoryInterface
{
    public function create(UsesInterface $uses): UsesViewInterface;
}
