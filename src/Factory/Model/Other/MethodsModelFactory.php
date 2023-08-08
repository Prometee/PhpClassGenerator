<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\AbstractModelFactory;
use Prometee\PhpClassGenerator\Model\Other\MethodsInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

/** @property class-string<MethodsInterface> $modelClass */
final class MethodsModelFactory extends AbstractModelFactory implements MethodsModelFactoryInterface
{
    public function create(UsesInterface $uses): MethodsInterface
    {
        return new $this->modelClass($uses);
    }
}
