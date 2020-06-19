<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Attribute\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\View\Other\PropertiesViewInterface;

final class PropertiesViewFactory implements PropertiesViewFactoryInterface
{
    /** @var string */
    protected $propertiesViewClass;
    /** @var PropertyViewFactoryInterface */
    protected $propertyViewFactory;

    public function __construct(
        string $propertiesViewClass,
        PropertyViewFactoryInterface $propertyViewFactory
    ) {
        $this->propertiesViewClass = $propertiesViewClass;
        $this->propertyViewFactory = $propertyViewFactory;
    }

    public function create(PropertiesInterface $properties): PropertiesViewInterface
    {
        return new $this->propertiesViewClass(
            $properties,
            $this->propertyViewFactory
        );
    }
}
