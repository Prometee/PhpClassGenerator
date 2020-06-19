<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Method;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;

interface AutoGetterSetterInterface
{
    public function configure(PropertyInterface $property): GetterSetterInterface;
}