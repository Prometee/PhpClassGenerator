<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\View\Attribute\AttributeViewInterface;

final class AttributeViewFactory implements AttributeViewFactoryInterface
{
    public function __construct(
        /** @var class-string<AttributeViewInterface> */
        private string $attributeViewClass,
    ) {
    }

    public function create(AttributeInterface $attribute): AttributeViewInterface
    {
        return new $this->attributeViewClass(
            $attribute,
        );
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
