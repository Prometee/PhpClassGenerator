<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

trait AttributeAwareTrait
{
    protected AttributeInterface $attribute;

    public function getAttribute(): AttributeInterface
    {
        return $this->attribute;
    }

    public function setAttribute(AttributeInterface $attribut): void
    {
        $this->attribute = $attribut;
    }
}
