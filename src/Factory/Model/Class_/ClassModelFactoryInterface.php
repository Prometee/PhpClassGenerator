<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Class_;

use Prometee\PhpClassGenerator\Factory\Model\Attribute\AttributeModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Class_\ClassInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface ClassModelFactoryInterface extends ModelFactoryInterface
{
    public function create(?UsesInterface $uses = null): ClassInterface;

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface;

    public function getAttributeModelFactory(): AttributeModelFactoryInterface;

    public function getPropertiesModelFactory(): PropertiesModelFactoryInterface;

    public function getUsesModelFactory(): UsesModelFactoryInterface;

    public function getMethodsModelFactory(): MethodsModelFactoryInterface;

    public function getTraitsModelFactory(): TraitsModelFactoryInterface;
}
