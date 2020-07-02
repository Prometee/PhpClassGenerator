<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Property;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface ConstantModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstantInterface;
}
