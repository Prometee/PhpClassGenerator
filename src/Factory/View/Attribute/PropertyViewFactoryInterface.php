<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\PropertyInterface;
use Prometee\PhpClassGenerator\View\Attribute\PropertyViewInterface;

interface PropertyViewFactoryInterface
{
    public function create(PropertyInterface $property): PropertyViewInterface;
}
