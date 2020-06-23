<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Model\Other\UseInterface;

interface UseModelFactoryInterface
{
    public function create(): UseInterface;
}
