<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Attribute\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;

class PropertiesView extends AbstractArrayView implements PropertiesViewInterface
{
    /** @var PropertiesInterface */
    protected $properties;
    /** @var PropertyViewFactoryInterface */
    protected $propertyViewFactory;

    public function __construct(
        PropertiesInterface $properties,
        PropertyViewFactoryInterface $propertyViewFactory
    ) {
        $this->properties = $properties;
        $this->propertyViewFactory = $propertyViewFactory;
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
