<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Property;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\View\Property\PropertyViewInterface;

final class PropertyViewFactory implements PropertyViewFactoryInterface
{
    public function __construct(
        /** @var class-string<PropertyViewInterface> */
        protected string $propertyViewClass,
        protected PhpDocViewFactoryInterface $phpDocViewFactory,
    ) {
    }

    public function create(PropertyInterface $property): PropertyViewInterface
    {
        return new $this->propertyViewClass(
            $property,
            $this->phpDocViewFactory
        );
    }
}
