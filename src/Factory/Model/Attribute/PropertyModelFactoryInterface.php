<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Factory\Model\PhpDoc\PhpDocModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface PropertyModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): PropertyInterface;

    public function getPhpDocModelFactory(): PhpDocModelFactoryInterface;
}
