<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Property;

use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\View\Property\PropertyViewInterface;

interface PropertyViewFactoryInterface
{
    public function create(PropertyInterface $property): PropertyViewInterface;
}
