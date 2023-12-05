<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\Model\Attribute;

use Prometee\PhpClassGenerator\Factory\Model\ModelFactoryInterface;
use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;

interface AttributeModelFactoryInterface extends ModelFactoryInterface
{
    public function create(): AttributeInterface;
}
