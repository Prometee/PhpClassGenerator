<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Factory\View\Attribute;

use Prometee\PhpClassGenerator\Model\Attribute\AttributeInterface;
use Prometee\PhpClassGenerator\View\Attribute\AttributeViewInterface;

interface AttributeViewFactoryInterface
{
    public function create(AttributeInterface $attribute): AttributeViewInterface;

    public function getAttributeViewClass(): string;

    /** @param class-string<AttributeViewInterface> $attributeViewClass */
    public function setAttributeViewClass(string $attributeViewClass): void;
}
