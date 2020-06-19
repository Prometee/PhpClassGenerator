<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\AutoGetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface AutoGetterSetterModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): AutoGetterSetterInterface;
}
