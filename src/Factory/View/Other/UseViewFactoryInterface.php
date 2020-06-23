<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Model\Other\UseInterface;
use Prometee\PhpClassGenerator\View\Other\UseViewInterface;

interface UseViewFactoryInterface
{
    public function create(UseInterface $useModel): UseViewInterface;
}
