<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Other;

use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\Model\Other\PropertiesInterface;
use Prometee\PhpClassGenerator\View\Other\PropertiesViewInterface;

final class PropertiesViewFactory implements PropertiesViewFactoryInterface
{
    public function __construct(
        /** @var class-string<PropertiesViewInterface> */
        protected string $propertiesViewClass,
        protected PropertyViewFactoryInterface $propertyViewFactory,
    ) {
    }

    public function create(PropertiesInterface $properties): PropertiesViewInterface
    {
        return new $this->propertiesViewClass(
            $properties,
            $this->propertyViewFactory
        );
    }
}
