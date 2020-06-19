<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\GetterSetterInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface GetterSetterModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): GetterSetterInterface;

    public function getMethodModelFactory(): MethodModelFactoryInterface;

    public function getMethodParameterFactory(): MethodParameterModelFactoryInterface;
}
