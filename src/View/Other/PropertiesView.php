<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;

class PropertiesView extends AbstractArrayView implements PropertiesViewInterface
{
    public function __construct(
        protected PropertiesInterface $properties,
        protected PropertyViewFactoryInterface $propertyViewFactory
    ) {
    }

    public function getArrayToBuild(): array
    {
        $views = [];
        foreach ($this->properties->getProperties() as $propertyGenerator) {
            $views[] = $this->propertyViewFactory->create($propertyGenerator);
        }

        return $views;
    }
}
