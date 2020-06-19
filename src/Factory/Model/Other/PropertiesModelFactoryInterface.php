<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Other;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface PropertiesModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): PropertiesInterface;
}
