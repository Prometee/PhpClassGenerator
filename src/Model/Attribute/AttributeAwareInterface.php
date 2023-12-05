<?php

declare(strict_types=1);

namespace Prometee\PhpClassGenerator\Model\Attribute;

interface AttributeAwareInterface
{
    public function getAttribute(): AttributeInterface;

    public function setAttribute(AttributeInterface $attribut): void;
}
