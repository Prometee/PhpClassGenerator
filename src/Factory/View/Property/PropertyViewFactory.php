<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Property;

use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Property\PropertyInterface;
use Prometee\PhpClassGenerator\View\Property\PropertyViewInterface;

final class PropertyViewFactory implements PropertyViewFactoryInterface
{
    /** @var string */
    protected $propertyViewClass;
    /** @var PhpDocViewFactoryInterface */
    protected $phpDocViewFactory;

    public function __construct(
        string $propertyViewClass,
        PhpDocViewFactoryInterface $phpDocViewFactory
    ) {
        $this->propertyViewClass = $propertyViewClass;
        $this->phpDocViewFactory = $phpDocViewFactory;
    }

    public function create(PropertyInterface $property): PropertyViewInterface
    {
        return new $this->propertyViewClass(
            $property,
            $this->phpDocViewFactory
        );
    }
}
