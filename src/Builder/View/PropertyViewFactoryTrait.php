<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\Attribute\AttributeViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\PhpDoc\PhpDocViewFactoryInterface;
use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Property\PropertyViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Property\PropertyView;
use Prometee\PhpClassGenerator\View\Property\PropertyViewInterface;

trait PropertyViewFactoryTrait
{
    private ?PropertyViewFactoryInterface $propertyViewFactory = null;

    /** @var class-string<PropertyViewFactoryInterface> */
    private string $propertyViewFactoryClass = PropertyViewFactory::class;

    /** @var class-string<PropertyViewInterface> */
    private string $propertyViewClass = PropertyView::class;

    abstract public function buildPhpDocViewFactory(): PhpDocViewFactoryInterface;
    abstract public function buildAttributeViewFactory(): AttributeViewFactoryInterface;

    public function buildPropertyViewFactory(): PropertyViewFactoryInterface
    {
        if (null === $this->propertyViewFactory) {
            $this->propertyViewFactory = new $this->propertyViewFactoryClass(
                $this->propertyViewClass,
                $this->buildPhpDocViewFactory(),
                $this->buildAttributeViewFactory(),
            );
        }

        return $this->propertyViewFactory;
    }

    public function getPropertyViewFactoryClass(): string
    {
        return $this->propertyViewFactoryClass;
    }

    public function setPropertyViewFactoryClass(string $propertyViewFactoryClass): void
    {
        $this->propertyViewFactoryClass = $propertyViewFactoryClass;
    }

    public function getPropertyViewClass(): string
    {
        return $this->propertyViewClass;
    }

    public function setPropertyViewClass(string $propertyViewClass): void
    {
        $this->propertyViewClass = $propertyViewClass;
    }
}
