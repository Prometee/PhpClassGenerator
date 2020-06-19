<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\ConstantInterface;
use Prometee\PhpClassGenerator\Model\Other\UsesInterface;

interface ConstantModelFactoryInterface extends ModelFactoryInterface
{
    public function create(UsesInterface $uses): ConstantInterface;
}
