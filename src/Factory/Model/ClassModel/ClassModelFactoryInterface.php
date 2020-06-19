<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\ClassModel;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\MethodsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\PropertiesModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\TraitsModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\Other\UsesModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\ClassModel\ClassModelInterface;

interface ClassModelFactoryInterface extends ModelFactoryInterface
{
    public function create(): ClassModelInterface;

    public function getPropertiesModelFactory(): PropertiesModelFactoryInterface;

    public function getUsesModelFactory(): UsesModelFactoryInterface;

    public function getMethodsModelFactory(): MethodsModelFactoryInterface;

    public function getTraitsModelFactory(): TraitsModelFactoryInterface;
}
