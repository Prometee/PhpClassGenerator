<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\TraitsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface TraitsModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): TraitsInterface;
}
