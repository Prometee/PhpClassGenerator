<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Builder\View;

use Prometee\PhpClassGenerator\Factory\View\Attribute\AttributeViewFactory;
use Prometee\PhpClassGenerator\Factory\View\Attribute\AttributeViewFactoryInterface;
use Prometee\PhpClassGenerator\View\Attribute\AttributeView;
use Prometee\PhpClassGenerator\View\Attribute\AttributeViewInterface;

trait AttributeViewFactoryTrait
{
    private ?AttributeViewFactoryInterface $attributeViewFactory = null;

    /** @var class-string<AttributeViewFactoryInterface> */
    private string $attributeViewFactoryClass = AttributeViewFactory::class;

    /** @var class-string<AttributeViewInterface> */
    private string $attributeViewClass = AttributeView::class;

    public function buildAttributeViewFactory(): AttributeViewFactoryInterface
    {
        if (null === $this->attributeViewFactory) {
            $this->attributeViewFactory = new $this->attributeViewFactoryClass(
                $this->attributeViewClass,
                $this->wrapOn
            );
        }

        return $this->attributeViewFactory;
    }

    public function getAttributeViewFactoryClass(): string
    {
        return $this->attributeViewFactoryClass;
    }

    public function setAttributeViewFactoryClass(string $attributeViewFactoryClass): void
    {
        $this->attributeViewFactoryClass = $attributeViewFactoryClass;
    }

    public function getAttributeViewClass(): string
    {
        return $this->attributeViewClass;
    }

    public function setAttributeViewClass(string $attributeViewClass): void
    {
        $this->attributeViewClass = $attributeViewClass;
    }
}
