<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Method;

use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Method\MethodInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface MethodModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): MethodInterface;

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function getAttributeModelFactory(): AttributeModelFactoryInterface;
}
