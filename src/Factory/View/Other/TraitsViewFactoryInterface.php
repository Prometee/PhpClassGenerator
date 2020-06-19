<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\View\Other\TraitsViewInterface;

interface TraitsViewFactoryInterface
{
    public function create(TraitsInterface $traits): TraitsViewInterface;
}
